<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Payment - Admin | Company Name</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}" />


</head>

<body>
    {{ view('nbar',  ['baseUrl' => env('BASE_URL')]) }}

    <input id="users-data" value="{{ $users }}" style="display:none">
    <input id="base-url" value="{{ env('BASE_URL') }}" style="display:none">

    <div class="m-3">
        <h1>Payment - Admin</h1>
    </div>

    <hr />

    <div>
        <div class="m-3 shadow shadow-md" id="table-users"></div>
    </div>

    <script>
        let users = []

        const render = async () => {
            try {
                document.querySelector('#table-users').innerHTML =
                    `
                        <table class="table table-bordered table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Payments</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${users.map((user, i) => {
                                    return `
                                        <tr>
                                            <td>${i + 1}</td>
                                            <td>${user?.user?.name}</td>
                                            <td>${user?.user?.username}</td>
                                            <td>${user?.user?.email}</td>
                                            <td>
                                                <div>
                                                    <button onclick="addPayment(${i})" class="btn btn-primary border rounded-circle">
                                                        <i class="bi bi-plus-lg"></i>
                                                    </button>
                                                    ${user?.payments?.map((payment, j) => {
                                                        return `
                                                            <div class="my-1 d-flex align-items-center">
                                                                <button class="btn btn-sm btn-danger">
                                                                    <i class="bi bi-trash"></i>
                                                                </button> 
                                                                <div class="mx-1" >Payment ${j}</div>
                                                                <div class="dropdown border  shadow mx-1">
                                                                    <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                                        ${`3x`}
                                                                    </button>
                                                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                                        <li><a class="dropdown-item" href="#">3x</a></li>
                                                                        <li><a class="dropdown-item" href="#">6x</a></li>
                                                                        <li><a class="dropdown-item" href="#">12x</a></li>
                                                                    </ul>
                                                                </div>
                                                                <div class="mx-1 shadow px-2 py-1">
                                                                    <input class="form-control" type="date" ></input>
                                                                    Due ${Intl.DateTimeFormat(navigator?.language ?? 'en-US', {dateStyle: 'medium'}).format(new Date())}
                                                                </div>
                                                                <div class="">
                                                                    Description
                                                                    <textarea 
                                                                        oninput="handleChangePaymentDescription(${i},${j})"  
                                                                        class="form-control" 
                                                                        placeholder="Description here..." 
                                                                        id="description-${i}-${j}" 
                                                                        class="form-control"
                                                                    >${payment?.description ?? ''}</textarea>
                                                                </div>
                                                                <div class="shadow px-2 py-1">
                                                                    <div class="form-floating">
                                                                        <input value="${payment?.amount ?? 0}" oninput="handleChangePaymentAmount(${i},${j})" type="number" id="amount-${i}-${j}" class="form-control"></input>
                                                                        <label for="amount-${i}-${j}">Amount</label>
                                                                    </div>                                                                       
                                                                    
                                                                    <div id="amount-display-${i}-${j}">${Intl.NumberFormat(navigator?.language ?? 'en-US', { style: 'currency', currency: 'IDR' }).format(payment?.amount ?? 0)}</div>
                                                                </div>
                                                                
                                                                
                                                                
                                                            </div>
                                                        `;
                                                    })?.join('')}
                                                </div>
                                                
                                            </td>
                                            
                                        </tr>
                                    `
                                    }).join('')}
                            </tbody>
                        </table>
                    `

            } catch (e) {
                console.error(e)
            }
        }

        const usersStr = document.querySelector('#users-data').value;

        if (usersStr) {
            users = JSON.parse(usersStr)

            console.log(users)
            render()
        }

        const addPayment = (i) => {
            users = users.map((user, ix) => i === ix ? {

                ...user,
                payments: user?.payments ? [
                    ...user.payments,
                    {
                        amount: 0
                    }
                ] : user?.payments
            } : user)

            render()
        }

        const handleChangePaymentAmount = (i, j, e) => {
            console.log(i, j, e)
            const amount = document.querySelector(`#amount-${i}-${j}`).value

            console.log('amountVal', amount, isNaN(parseInt(amount)))

            users = users.map((user, ix) => i === ix ? {
                ...user,
                payments: user?.payments ?
                    user.payments.map((payment, jx) => j === jx ? {
                        ...payment,
                        amount: isNaN(parseInt(amount)) ? payment?.amount : parseInt(amount)
                    } : payment) : user?.payments
            } : user)

            document.querySelector(`#amount-display-${i}-${j}`).innerHTML = Intl.NumberFormat(navigator?.language ?? 'en-US', {
                style: 'currency',
                currency: 'IDR'
            }).format(isNaN(parseInt(amount)) ? 0 : parseInt(amount))
        }

        const handleChangePaymentDescription = (i, j, e) => {
            console.log(i, j, e)
            const desc = document.querySelector(`#description-${i}-${j}`).value

            console.log('desc', desc)

            users = users.map((user, ix) => i === ix ? {
                ...user,
                payments: user?.payments ?
                    user.payments.map((payment, jx) => j === jx ? {
                        ...payment,
                        description: desc
                    } : payment) : user?.payments
            } : user)

            console.log(document.querySelector(`#description-${i}-${j}`))

            document.querySelector(`#description-${i}-${j}`).value = desc
        }
    </script>
</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</html>