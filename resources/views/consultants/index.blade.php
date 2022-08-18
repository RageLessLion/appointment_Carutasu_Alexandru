<x-layout>
    <section class="relative h-72 bg-yellow-600 flex flex-col justify-center align-center text-center space-y-4 mb-4">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
        ></div>

        <div class="z-10">
            <h1 class="text-6xl font-bold uppercase text-white">
                Appointment<span class="text-black">Scheduler</span>
            </h1>
            <p class="text-2xl text-gray-200 font-bold my-4">
                Find a consultant and select a time
            </p>
            <div>
                @auth
                    <a href="/appointments/create"
                       class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Create an appointment</a>
                @else
                    <a href="/login"
                       class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl uppercase mt-2 hover:text-black hover:border-black">Sign in to make an appointment</a>
                @endauth
            </div>
        </div>
    </section>

    @include('partials._search')

    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

        @unless(count($consultants) == 0)

            @foreach($consultants as $consultant)   <div class="bg-gray-50 border border-gray-200 rounded p-6">
                <div class="flex">
                    <div>
                        <h3 class="text-2xl">
                            <a href="#">{{$consultant->name}}</a>
                        </h3>
                        <div class="text-xl font-bold mb-4">
                            {{$consultant->email}}
                        </div>
                        <div class="text-lg mt-4">
                            <i class="fa-solid fa-location-dot"></i> {{$consultant->address}}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        @else
            <p>No appointments found</p>
        @endunless

    </div>
    <div class="mt-6 p-4">
    </div>
</x-layout>
