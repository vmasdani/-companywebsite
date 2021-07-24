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
    let paymentDetails = []

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

    const fetchUserPaymentDetailsData = async () => {
      try {
        const resp = await fetch(`${baseUrl}/user-get-payment-details`, {
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
      const [userData, paymentsData, paymentDetailsData] = await Promise.all([fetchUserData(), fetchUserPaymentData(), fetchUserPaymentDetailsData()])

      user = userData
      payments = paymentsData
      paymentDetails = paymentDetailsData

      render()
    }

    const pay = (epoch) => {
      if (paymentDetails.find(paymentDetail => paymentDetail?.paymentDetail?.epoch === epoch)) {
        alert('Payment already found.')
      } else {
        const confirmation = confirm(`Really pay ${new Date(epoch)}?`)


        if (confirmation) {
          paymentDetails = [...paymentDetails,
            {
              paymentDetail: {
                epoch: epoch
              }
            }
          ]
        } else {
          alert('Payment cancelled.')
        }


      }


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
                                    <strong class="text-primary">
                                      Done: ${paymentDetails?.length ?? 0}/${(payment?.years ?? 0) * 12} 
                                      <span class="text-success">
                                        ${
                                          Intl.NumberFormat(navigator.language ?? 'en-US', {style: 'currency', currency: 'IDR'}).format (
                                            ((payment?.amount ?? 0) / (payment?.years ?? 1)  / 12) * (paymentDetails?.length ?? 0)) 
                                          }
                                      </span>
                                    </strong>
                            </div>

                            <div class="overflow-auto shadow bg-light" style="height:30vh;resize:vertical">
                                <table class="table table-bordered table-sm table-hover">    
                                    <thead>
                                        <tr>
                                          ${['#', 'Tahun', 'Bulan', 'Tanggal Lengkap', 'Nominal Bayar', 'Status', 'Bukti'].map(head => 
                                              `<th class="bg-secondary text-light" style="top:0;position:sticky">${head}</th>
                                            `).join('')}
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
                                                    <td>
                                                        <div onclick="pay(${newDate})" style="cursor:pointer">
                                                            ${
                                                                paymentDetails.find(paymentDetail => paymentDetail?.paymentDetail?.epoch === newDate)
                                                                    ?   `
                                                                            <div class="text-success fw-bold">
                                                                                Lunas
                                                                            </div>
                                                                        `
                                                                    :   `
                                                                            <div class="text-danger fw-bold">
                                                                                Belum lunas
                                                                            </div>
                                                                        `
                                                            }
                                                        </div>
                                                        
                                                    </td>
                                                    <td>
                                                        ${
                                                            paymentDetails.find(paymentDetail => paymentDetail?.paymentDetail?.epoch === newDate)
                                                                ?   `
                                                                        <div>
                                                                            <input type="file" />
                                                                        </div>
                                                                    `
                                                                :   `
                                                                        
                                                                    `
                                                        }
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