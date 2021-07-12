<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Users | Company Name</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/bootstrap-icons.css') }}">

</head>

<body>
    {{ view('nbar',  ['baseUrl' => env('BASE_URL')]) }}

    <input id="users-data" value="{{ $users }}" style="display:none">

    <div class="m-3">
        <h1>Users</h1>
    </div>

    <hr />

    <div class="m-3">
        <div class="shadow shadow-md">
            <div>
                <button id="add-btn" class="btn btn-primary"><i class="bi bi-plus"></i>Add</button </div>
                <button id="save-btn" class="btn btn-success"><i class="bi bi-save"></i>Save</button </div>

                <div id="users-table" class="">

                </div>
            </div>

        </div>

        <script>
            let users = []

            const render = () => {
                document.querySelector('#users-table').innerHTML = `
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Username</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${users.map((user, i) => {
                            return `
                                <tr>
                                    <td>${i + 1}</td>
                                    <td>
                                        <input class="form-control" placeholder="Name..." value="${user?.name}">
                                    </td>
                                    <td>
                                        <input class="form-control" placeholder="Username..." value="${user?.username}">
                                    </td>
                                    
                                </tr>
                            `;
                        }).join('')}
                    </tbody>
                </table>
                    
                `
            }

            const usersStr = document.querySelector('#users-data').value;


            if (usersStr) {
                users = JSON.parse(usersStr)

                console.log(users)
                render()
            }

            document.querySelector('#add-btn').addEventListener('click', () => {
                users = [...users,
                    {
                        id: null,
                        username: '',
                        name: ''
                    }
                ]

                render()
            })

            document.querySelector('#save-btn').addEventListener('click', () => {
                window.location.reload()
            })
        </script>

</body>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


</html>