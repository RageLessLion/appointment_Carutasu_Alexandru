<x-layout>
        <div
            class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24"
        >
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Create an appointment
                </h2>
            </header>

            <form  method="POST" action="/appointments">
                @csrf


                <div class="mb-6">
                    <label
                        for="start_time"
                        class="inline-block text-lg mb-2"
                    >Start Time</label
                    >
                    <input
                        type="date"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="start_time" id="date"
                    />
                    @error('start_time')
                      <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>



                <div class="mb-6">
                    <label
                        for="finish_time"
                        class="inline-block text-lg mb-2"
                    >Finish Time</label
                    >
                    <input
                        type="datetime-local"
                        class="border border-gray-200 rounded p-2 w-full"
                        name="finish_time"
                    />
                    @error('finish_time')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="consultant_id"
                        class="inline-block text-lg mb-2"
                    >
                        Choose your consultant
                    </label>
                    <select  class="border border-gray-200 rounded p-2 w-full" name="consultant_id" id="consultant_id">
                        @php
                            $consultants =\App\Models\Consultant::all();
                        @endphp

                        @foreach($consultants as $consultant)
                            <option id="{{$consultant->id}}" value="{{$consultant->id}}">{{$consultant->name}}</option>
                        @endforeach
                    </select>

                    @error('consultant_id')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label
                        for="description"
                        class="inline-block text-lg mb-2"
                    >
                        Appointment Specifications
                    </label>
                    <textarea
                        class="border border-gray-200 rounded p-2 w-full"
                        name="description"
                        rows="10"
                        placeholder="Feel free to write any specifications regarding your appointment..."
                    ></textarea>
                    @error('description')
                    <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <button
                        class="bg-yellow-600 text-white rounded py-2 px-4 hover:bg-black"
                    >
                        Create appointment
                    </button>
                </div>
            </form>

            <button id="testing" class="bg-yellow-600 text-white rounded py-2 px-4 hover:bg-black">
               Testing
            </button>
        </div>
</x-layout>

<script>
    const date = document.querySelector('#date');
    document.querySelector('#testing').addEventListener('click',function(){
       console.log(date.value);
    });
</script>
