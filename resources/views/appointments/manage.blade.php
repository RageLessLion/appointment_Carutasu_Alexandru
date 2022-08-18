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
                            <a href="#"> Appointment from {{$appointment->start_time}} with {{$appointment->consultant->name}}</a>
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
                        <p class="text-center">No appointments Found</p>
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
      if(confirm("do you really want to delete this record?"))
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



</script>
