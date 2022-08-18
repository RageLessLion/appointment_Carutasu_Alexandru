<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="images/favicon.ico" />
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer"
    />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        laravel: "#ef3b2d",
                    },
                },
            },
        };
    </script>
    <title>Appointment Scheduler</title>
</head>
<body class="mb-48">
<nav class="flex justify-between items-center mb-4">
    <a href="index.html"
    ><img class="w-24" src="images/logo.png" alt="" class="logo"
        /></a>
    <ul class="flex space-x-6 mr-6 text-lg">
        <li>
            <a href="/Register" class="hover:text-laravel"
            ><i class="fa-solid fa-user-plus"></i> Register</a
            >
        </li>
        <li>
            <a href="/login" class="hover:text-laravel"
            ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                Login</a
            >
        </li>
    </ul>
</nav>

<main>
    <div class="mx-4">
        <div
            class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
        >
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Edit a consultant
                </h2>
            </header>

            <form method="POST" action="/consultants/{{$consultant->id}}">
                @csrf
                @method('PUT')
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        Name
                    </label>
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="name"
                        value="{{$consultant->name}}"
                    />
                    @error('name')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2"
                    >Email</label
                    >
                    <input
                        type="email"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="email"
                        value="{{$consultant->email}}"
                    />
                    @error('email')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="phone" class="inline-block text-lg mb-2"
                    >Phone</label
                    >
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="phone"
                        value="{{$consultant->phone}}"
                    />
                    @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="address" class="inline-block text-lg mb-2"
                    >Address</label
                    >
                    <input
                        type="text"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="address"
                        value="{{$consultant->address}}"
                    />
                    @error('address')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>


                <div class="mb-6">
                    <button
                        type="submit"
                        class="bg-yellow-600 text-white rounded py-2 px-4 hover:bg-black"
                    >
                        Edit Consultant
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>

<footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-yellow-600 text-white h-24 mt-24 opacity-90 md:justify-center">
    <p class="ml-2">Copyright &copy; 2022, All Rights reserved</p>
</footer>
</body>
</html>
