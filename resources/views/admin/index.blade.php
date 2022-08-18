<x-layout>
    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Appointments
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
            @unless($appointments->isEmpty())
                @foreach($appointments as $appointment)
                    <tr class="border-gray-300">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="#"> Appointment from {{$appointment->start_time}} with {{$appointment->consultant->name}} made by {{$appointment->user}} </a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="/appointments/{{$appointment->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                    class="fa-solid fa-pen-to-square"></i>
                                Edit</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <button class="text-red-500" onclick="deleteAppointment({{$appointment->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
                            {{--                                <a href="#" onclick="deleteAppointment({{$appointment->id}})">Delete</a>--}}
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No appointments found</p>
                    </td>
                </tr>
            @endunless
            </tbody>
        </table>
    </x-card>

    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Users
            </h1>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
            @unless($users->isEmpty())
                @foreach($users as $user)
                    <tr class="border-gray-301">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="#"> Name : {{$user->name}}</a>
                            <a href="#"> Email : {{$user->email}}</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="/users/{{$user->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                    class="fa-solid fa-pen-to-square"></i>
                                Edit</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <button class="text-red-500" onclick="deleteUser({{$user->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No users found</p>
                    </td>
                </tr>
            @endunless
            </tbody>
        </table>
    </x-card>

    <x-card class="p-10">
        <header>
            <h1 class="text-3xl text-center font-bold my-6 uppercase">
                Manage Consultants
            </h1>
            <a href="/consultants/create" class="text-blue-400 px-6 py-2 rounded-xl"><i
                    class="fa-solid fa-pen-to-square"></i>
                Create Consultant</a>
        </header>

        <table class="w-full table-auto rounded-sm">
            <tbody>
            @unless($consultants->isEmpty())
                @foreach($consultants as $consultant)
                    <tr class="border-gray-302">
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="#"> Name : {{$consultant->name}}</a>
                            <a href="#"> Email : {{$consultant->email}}</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <a href="/consultants/{{$consultant->id}}/edit" class="text-blue-400 px-6 py-2 rounded-xl"><i
                                    class="fa-solid fa-pen-to-square"></i>
                                Edit</a>
                        </td>
                        <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                            <button class="text-red-500" onclick="deleteConsultant({{$consultant->id}})"><i class="fa-solid fa-trash"></i> Delete</button>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr class="border-gray-300">
                    <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                        <p class="text-center">No consultants found</p>
                    </td>
                </tr>
            @endunless
            </tbody>
        </table>


    </x-card>

</x-layout>

<script>
    function deleteAppointment(id)
    {
        if(confirm("do you really want to delete this appointment?"))
        {
            $.ajax({
                url:'/appointments/'+id,
                type:'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response)
                {
                    document.querySelector(".border-gray-300").remove();
                }
            });
        }
    }

    function deleteUser(id)
    {
        if(confirm("do you really want to delete this user?"))
        {
            $.ajax({
                url:'/users/'+id,
                type:'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response)
                {
                    document.querySelector(".border-gray-301").remove();
                }
            });
        }
    }

    function deleteConsultant(id)
    {
        if(confirm("do you really want to delete this user?"))
        {
            $.ajax({
                url:'/consultants/'+id,
                type:'DELETE',
                data:{
                    _token: $("input[name=_token]").val()
                },
                success:function(response)
                {
                    document.querySelector(".border-gray-302").remove();
                }
            });
        }
    }



</script>
