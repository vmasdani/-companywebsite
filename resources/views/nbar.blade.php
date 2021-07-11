<nav class="navbar sticky-top top-0 navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">

        <a class="navbar-brand" href="{{ $baseUrl ?? '' }}">Company Website</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ $baseUrl ?? '' }}">Home</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="about">About</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="admin-dropdown">

                    </ul>
                </li>
            </ul>
            <form id="logout-form" class="d-flex">

            </form>
        </div>
    </div>

    <script>
        document.querySelector('#logout-form').innerHTML = localStorage.getItem('apiKey') ?
            `<button class="btn btn-outline-danger" type="submit" id="logout-btn">Logout</button>` :
            ''

        document.querySelector('#logout-btn')?.addEventListener('click', () => {
            localStorage.removeItem('apiKey')

            alert('Logout success.')

            window.location.reload()
        })

        document.querySelector('#admin-dropdown').innerHTML =
            localStorage.getItem('apiKey') ?
            `
                        <li><a class="dropdown-item" href="">Users</a></li>
                        <li><a class="dropdown-item" href="">Payment - Admin</a></li>
                        <li><a class="dropdown-item" href="">Payment - User</a></li>
                        
                    ` :
            `<li><a class="dropdown-item" href="login">Login</a></li>
           
            `;
    </script>
</nav>