<x-layout>


    <div
        class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create an appointment
        </h2>
    </header>

    <form method="POST" action="/appointments"
    >
        @csrf
            <div class="mb-6">
                <label for="consultant" class="mb-2 h2">
                    Consultant
                </label>
                <select class="form-select border-0"
                        name="consultant" id="consultant" required
                >
                    <option selected disabled="disabled" class="border border-gray-200 rounded p-2 w-full" hidden>
                        Choose a consultant
                    </option>
                    @foreach($consultants as $consultant)
                        <option  class="border border-gray-200 rounded p-2 w-full" id="{{ $consultant->id }}"
                                value="{{ $consultant->id }}">
                            {{ $consultant->name }}
                            {{ $consultant->email}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-6" id="div-date" hidden>
                <label for="date"  class="inline-block text-lg mb-2">
                    Date
                </label>
                <input type="date"   class="border border-gray-200 rounded p-2 w-full"
                       name="date" id="date"
                       min="{{ date('Y-m-d') }}" required
                >
            </div>

            <div class="mb-6" id="div-time">
            </div>

        <div class="mb-6">
            <button
                class="bg-yellow-600 text-white rounded py-2 px-4 hover:bg-black"
            >
                Create appointment
            </button>
        </div>
    </form>
    </div>
</x-layout>

<script>
    const dateInput = document.querySelector('#date')
    const consultantInput = document.querySelector('#consultant')

    dateInput.addEventListener('input', getFreeHours)

    function getFreeHours() {
        const input = dateInput.value
        const divTime = document.querySelector('#div-time')
        const submitButton = document.querySelector('#submit')

        const xhr = new XMLHttpRequest()
        const consultant = consultantInput.options[consultantInput.selectedIndex].id
        xhr.open('GET', `/consultants/availability/${consultant}/${input}`, true)

        xhr.onload = function () {
            const appointments = JSON.parse(this.response)

            let options
            let hourStart = new Date(`${input} 09:00:00`)

            while(hourStart.getTime() < new Date(`${input} 21:00:00`).getTime()) {
                if(hourStart.getTime() !== new Date(`${input} 13:30:00`).getTime()) {
                    let time = `${input} ${hourStart.toTimeString().split(' ')[0]}`

                    if(!appointments.includes(time)) {
                        const hourEnd = new Date(hourStart)
                        hourEnd.setMinutes(hourStart.getMinutes() + 60)

                        const value = hourStart.toLocaleTimeString('en-US', {
                            year: 'numeric',
                            month: '2-digit',
                            day: '2-digit',
                            hour12: false
                        })
                        console.log(value)
                        options += `<option value="${value}">
                            ${hourStart.toTimeString().split(' ')[0]} -
                            ${new Date(hourEnd).toTimeString().split(' ')[0]}
                        </option>`
                    }
                }

                hourStart.setMinutes(hourStart.getMinutes() + 90)
            }

            divTime.innerHTML = ''
            if(options) {
                const label = document.createElement('label')
                label.className = 'mb-2 h2'
                label.setAttribute('for', 'time')
                label.innerHTML = 'Time'

                const select = document.createElement('select')
                select.className = 'form-control border-0'
                select.setAttribute('name', 'time')
                select.setAttribute('id', 'time')
                select.setAttribute('required', '')
                select.innerHTML = options

                const small = document.createElement('label')
                small.className = 'my-2'
                small.setAttribute('for', 'time')
                small.innerHTML = 'Appointments last 1 hour'

                divTime.appendChild(label)
                divTime.appendChild(select)
                divTime.appendChild(small)

                submitButton.classList.remove('disabled')
            } else {
                const error = document.createElement('div')
                error.className = 'alert alert-danger text-center'
                error.innerHTML = 'There are no free spots for this consultant on this date. ' +
                    'Choose a different one'

                divTime.appendChild(error)

                if(!submitButton.classList.contains('disabled')) {
                    submitButton.classList.add('disabled')
                }
            }
        }

        xhr.send()
        consultantInput.addEventListener('input', getFreeHours)
    }

    consultantInput.addEventListener('input', showDateInput)

    function showDateInput() {
        const divDate = document.querySelector('#div-date')
        divDate.removeAttribute('hidden')
    }
</script>
