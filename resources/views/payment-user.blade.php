<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payment - User | Company Name</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />

</head>

<body>
    {{ view('nbar',  ['baseUrl' => env('BASE_URL')]) }}

    <input id="base-url" value="{{ $baseUrl }}" style="display:none"></input>

    <div class="m-3">
        <h1>Payment - User</h1>
    </div>

    <hr />

    <div class="m-3">
        <h5 id="user-name"></h5>
    </div>

    <div id="user-payments"></div>

    <script>
        const baseUrl = document.querySelector(`#base-url`).value

        // State
        let user = null
        let payments = []


        const fetchUserData = async () => {
            try {
                const resp = await fetch(`${baseUrl}/user-get`, {
                    headers: {
                        'authorization': `Bearer ${localStorage.getItem('apiKey')}`
                    }
                })
                if (resp.status !== 200) throw await resp.text()

                return (await resp.json())
            } catch (e) {
                console.error(e)
                return null
            }

        }

        const fetchUserPaymentData = async () => {
            try {
                const resp = await fetch(`${baseUrl}/user-get-payments`, {
                    headers: {
                        'authorization': `Bearer ${localStorage.getItem('apiKey')}`
                    }
                })
                if (resp.status !== 200) throw await resp.text()

                return (await resp.json())
            } catch (e) {
                console.error(e)
                return []
            }

        }

        const fetchData = async () => {
            const [userData, paymentsData] = await Promise.all([fetchUserData(), fetchUserPaymentData()])

            user = userData
            payments = paymentsData

            render()
        }

        const render = () => {
            document.querySelector('#user-name').innerHTML = user?.name ? `Payments for user ${user?.name}` : 'No user'

            document.querySelector('#user-payments').innerHTML = `
                ${payments.map((payment, i) => {
                    return `
                        <div class="m-3">
                            <div>${i + 1}. ${payment?.note}</div>
                            <div>
                                <h4>Cicilan ${payment?.years ?? 0} tahun, harga ${Intl.NumberFormat(navigator.language ?? 'en-US', {style: 'currency', currency: 'IDR'}).format (payment?.amount ?? 0)}, per bulan ${Intl.NumberFormat(navigator.language ?? 'en-US', {style: 'currency', currency: 'IDR'}).format ((payment?.amount ?? 0) / (payment?.years ?? 1)  / 12)}</h4>
                            </div>
                            <div class="my-3">
                                <strong class="text-primary">
                                    Start: ${
                                        payment?.date 
                                            ? Intl.DateTimeFormat(navigator.language ?? 'en-US', {dateStyle: 'full', }).format(new Date(payment.date)) 
                                            : 'No Date'
                                    }
                                </strong>
                            </div>

                            <div class="my-3">
                                <strong>Detail bukti cicilan:</strong>
                            </div>

                            <div>
                                    <strong class="text-primary">Done: 0/${(payment?.years ?? 0) * 12}</strong>
                            </div>

                            <div class="overflow-auto shadow bg-light" style="height:30vh;resize:vertical">
                                <table class="table table-bordered table-sm table-hover">    
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Tahun</th>
                                            <th>Bulan</th>
                                            <th>Tanggal Lengkap</th>
                                            <th>Nominal Bayar</th>
                                            <th>Status</th>
                                            <th>Bukti</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${[...Array((payment?.years ?? 0) * 12)].map((_, i) => {
                                            const paymentDate = payment?.date ? new Date(payment?.date) : null;
                                            const newDate = paymentDate ? Date.UTC(paymentDate.getFullYear(), paymentDate.getMonth() + i, paymentDate.getDate()) : null;

                                            return `
                                                <tr>
                                                    <td>${i + 1}</td>
                                                    <td>${Math.floor (i / 12) + 1}</td>
                                                    <td>${(i % 12) + 1}</td>
                                                    <td>
                                                        ${
                                                            Intl.DateTimeFormat(navigator.language ?? 'en-US', {dateStyle: 'full', timeZone: 'UTC'}).format(newDate) 
                                                        }
                                                    </td>
                                                    <td>
                                                        ${
                                                            Intl.NumberFormat(navigator.language ?? 'en-US', {style: 'currency', currency: 'IDR'}).format ((payment?.amount ?? 0) / (payment?.years ?? 1)  / 12)
                                                        }
                                                    </td>
                                                    <td><strong class="text-danger">BELUM BAYAR</strong></td>
                                                    <td>
                                                        <input type="file" />
                                                    </td>
                                                </tr>
                                            `
                                        }).join('')}
                                    
                                    </tbody>
                                    
                                </table>
                            </div>
                        </div>
                        <hr />
                    `
                }).join('')}
            `


        }

        fetchData()
    </script>

</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</html>