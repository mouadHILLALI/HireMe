@extends('layouts.mynav')
@section('home')
    @if (auth()->user()->confirm == 1)
        <div class="px-8 py-6 bg-green-400 text-white flex justify-between rounded " x-data="{show : true}" x-init="setTimeout(()=> show = false , 3000)"
            x-show="show">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                </svg>
                <p>Your Profile was registerd Succesfully</p>
            </div>
        </div>
        <div class="container mx-auto px-4 mt-3">
            @foreach ($data as $candidate)
                <div class=" flex flex-col min-w-0 break-words bg-white w-full mb-6 shadow-xl rounded-lg ">
                    <div class="px-6">
                        <div class="flex w-full items-center justify-center mt-3 gap-x-6">
                            <img class="object-cover w-40 h-40 rounded-full" src="{{ asset('images/' . $candidate->photo) }}"
                                alt="...">
                        </div>
                        <div class="text-center mt-12">
                            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
                                {{ $candidate->name }}
                            </h3>
                            <div class="text-sm leading-normal mt-0 mb-2 text-blueGray-400 font-bold uppercase">
                                <i class="fas fa-map-marker-alt mr-2 text-lg text-blueGray-400"></i>
                                {{ $candidate->address }}
                            </div>
                            <div class="mb-2 text-blueGray-600 mt-10">
                                <i
                                    class="fas fa-briefcase mr-2 text-lg text-blueGray-400"></i>{{ $candidate->current_position }}
                            </div>
                            <div class="mb-2 text-blueGray-600">
                                <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>{{ $candidate->industry }}
                            </div>
                        </div>
                        <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
                            <div class="flex flex-wrap justify-center">
                                <div class="w-full lg:w-9/12 px-4">
                                    <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                                        {{ $candidate->about }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if (auth()->user()->hasCv == 0)
            <div class="p-8 rounded border border-gray-200">
                <h1 class="font-medium text-3xl">Add Your CV</h1>
                <p class="text-gray-600 mt-6">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Dignissimos dolorem
                    vel
                    cupiditate laudantium dicta.</p>
                <form enctype="multipart/form-data" method="POST" action="{{ route('cv.add') }}">
                    @csrf
                    <div> <label for="name" class="text-sm text-gray-700 block mb-1 font-medium">Name</label> <input
                            type="text" name="name" id="name"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Enter your name" /> </div>
                    @error('name')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <input type="text" value="{{ auth()->user()->id }}" name="candidate_id" class="hidden" />
                    <div> <label for="email" class="text-sm text-gray-700 block mb-1 font-medium">Email Adress</label>
                        <input type="text" name="email" id="email"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="yourmail@provider.com" />
                    </div>
                    @error('email')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="job" class="text-sm text-gray-700 block mb-1 font-medium">Photo</label>
                        <input type="file" name="cvphoto"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3  focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full" />
                    </div>
                    @error('photo')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="skills" class="text-sm text-gray-700 block mb-1 font-medium">Skills</label>
                        <input type="text" name="skills" id="skills"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Design , please separate skills by commas" />
                    </div>

                    <div class="text-2xl font-bold mt-2">
                        <h1>Education</h1>
                    </div>
                    <div> <label for="job" class="text-sm text-gray-700 block mb-1 font-medium">Diploma</label>
                        <input type="text" name="diplome" id="job"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Bachelor" />
                    </div>
                    @error('Diplome')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="job" class="text-sm text-gray-700 block mb-1 font-medium">School</label>
                        <input type="text" name="school" id="job"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Youcode" />
                    </div>
                    @error('school')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="job" class="text-sm text-gray-700 block mb-1 font-medium">Start date</label>
                        <input type="date" name="start_date_school" id="job"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full" />
                    </div>
                    @error('start_date_school')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="job" class="text-sm text-gray-700 block mb-1 font-medium">End date</label>
                        <input type="date" name="end_date_school" id="job"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Youcode" />
                    </div>
                    @error('end_date_school')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="text-2xl font-bold mt-2">
                        <h1>Experiences</h1>
                    </div>
                    <div> <label for="poste" class="text-sm text-gray-700 block mb-1 font-medium">Poste :</label>
                        <input type="text" name="poste" id="poste"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="developper" />
                    </div>
                    @error('poste')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="company" class="text-sm text-gray-700 block mb-1 font-medium">Company :</label>
                        <input type="text" name="company" id="company"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Youcode" />
                    </div>
                    @error('company')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="start_date" class="text-sm text-gray-700 block mb-1 font-medium">Start date
                            :</label>
                        <input type="date" name="start_date_exp" id="start_date"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Youcode" />
                    </div>
                    @error('start_date_exp')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div> <label for="end_date" class="text-sm text-gray-700 block mb-1 font-medium">End date :</label>
                        <input type="date" name="end_date_exp" id="end_date"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="Youcode" />
                    </div>
                    @error('end_date_exp')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="text-2xl font-bold mt-2">
                        <h1>Languages</h1>
                    </div>
                    <div> <label for="name" class="text-sm text-gray-700 block mb-1 font-medium">name</label>
                        <input type="text" name="langname" id="name"
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            placeholder="English" />
                    </div>
                    @error('langname')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror

                    <div> <label for="proficiency"
                            class="text-sm text-gray-700 block mb-1 font-medium">proficiency</label>
                        <select
                            class="bg-gray-100 border border-gray-200 rounded py-1 px-3 block focus:ring-blue-500 focus:border-blue-500 text-gray-700 w-full"
                            id="proficiency" name="proficiency">
                            <option value="A1">A1</option>
                            <option value="A2">A2</option>
                            <option value="B1">B1</option>
                            <option value="B2">B2</option>
                            <option value="C1">C1</option>
                            <option value="C2">C2</option>
                        </select>
                    </div>

                    <div class="space-x-4 mt-8"> <button type="submit"
                            class="py-2 px-4 bg-blue-500 text-white rounded hover:bg-blue-600 active:bg-blue-700 disabled:opacity-50">Save</button>
                        <button
                            class="py-2 px-4 bg-white border border-gray-200 text-gray-600 rounded hover:bg-gray-100 active:bg-gray-200 disabled:opacity-50">Cancel</button>
                    </div>
                </form>
            </div>
        @else
            @foreach ($data as $candidate)
                <div
                    class=" flex w-[90%] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md mt-5 m-auto mb-3">
                    <div
                        class="reFlative mx-4 -mt-6 h-40 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-blue-500 to-blue-600">
                    </div>
                    <div class="p-6">
                        <h5
                            class="mb-2 block font-sans text-xl font-semibold leading-snug tracking-normal text-blue-gray-900 antialiased">
                            {{ auth()->user()->name }}
                        </h5>
                        <p class="block font-sans text-base font-light leading-relaxed text-inherit antialiased">
                            {{ $candidate->titre }}
                        </p>
                    </div>
                    <div class="p-6 pt-0">
                        <a target="blank" href="{{ route('download.cv') }}"
                            class="duration-300 hover:bg-sky-900 border hover:text-gray-50 bg-gray-50 font-semibold text-sky-800 px-1 py-1 flex flex-row items-center gap-3">Dowload
                            CV
                            <svg y="0" xmlns="http://www.w3.org/2000/svg" x="0" width="100" viewBox="0 0 100 100"
                                preserveAspectRatio="xMidYMid meet" height="100" class="w-6 h-6 fill-current">
                                <path fill-rule="evenodd"
                                    d="M22.1,77.9a4,4,0,0,1,4-4H73.9a4,4,0,0,1,0,8H26.1A4,4,0,0,1,22.1,77.9ZM35.2,47.2a4,4,0,0,1,5.7,0L46,52.3V22.1a4,4,0,1,1,8,0V52.3l5.1-5.1a4,4,0,0,1,5.7,0,4,4,0,0,1,0,5.6l-12,12a3.9,3.9,0,0,1-5.6,0l-12-12A4,4,0,0,1,35.2,47.2Z">
                                </path>
                            </svg>
                        </a>

                        <a target="blank" href="{{ route('cv') }}"
                            class="duration-300 hover:bg-sky-900 border hover:text-gray-50 bg-gray-50 font-semibold text-sky-800 px-1 py-1 flex flex-row items-center gap-3">View
                            CV
                        </a>
                        <form action="{{route('cv.delete')}}" method="POST" class="w-full">
                            @csrf
                            @method('DELETE')
                            <input type="text" name="cv_id" class="hidden" value="{{$cv->id}}">
                            <button class="duration-300 hover:bg-red-600 border hover:text-gray-50 bg-gray-50 font-semibold text-sky-800 px-1 py-1 flex flex-row items-center gap-3 w-full">Delete</button>
                        </form>
                    </div>
                </div>
            @endforeach
        @endif
    @else
        <div class="px-8 py-6 bg-yellow-400 text-white flex justify-between rounded">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 mr-6" viewBox="0 0 20 20" fill="currentColor">
                    <path
                        d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z" />
                </svg>
                <p>Please Register your profile</p>
            </div>
        </div>
        <h1 class="text-xl font-bold">Register Your Profile: </h1>

        <form action="{{ route('candidate.confirm') }}" method="POST" class="w-[50%] m-auto flex flex-col gap-2"
            enctype="multipart/form-data">
            @csrf
            <div class="flex gap-1 ">
                <div class="flex flex-col w-1/2">
                    <input type="file" id="photo" name="photo" value="{{ old('photo') }}"
                        class="border-none py-2 px-8 rounded-xl">
                    <input type="text" name="user_id" value="{{ auth()->user()->id }}"
                        class="border-none py-1 px-8 rounded-xl hidden">
                    <input type="text" name="name" value="{{ auth()->user()->name }}"
                        class="border-none py-1 px-8 rounded-xl hidden">
                    <input type="text" name="email" value="{{ auth()->user()->email }}"
                        class="border-none py-1 px-8 rounded-xl hidden">
                    @error('photo')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col w-1/2">
                    <input type="text" id="titre" name="titre" value="{{ old('titre') }}"
                        placeholder="entre your title" class="border-none py-2 px-8 rounded-xl">
                    @error('titre')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex gap-1 ">
                <div class="flex flex-col w-1/2">
                    <input type="text" id="current_position" name="current_position"
                        value="{{ old('current_position') }}" placeholder="entre your current position"
                        class="border-none py-2 px-8 rounded-xl">
                    @error('current_position')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex flex-col w-1/2">
                    <input type="text" id="industry" name="industry" value="{{ old('industry') }}"
                        placeholder="entre your industry" class="border-none py-2 px-8 rounded-xl">
                    @error('industry')
                        <p class="text-red-500">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <input type="text" id="address" name="address" value="{{ old('address') }}"
                placeholder="entre your current address" class="border-none py-2 px-8 rounded-xl">
            @error('address')
                <p class="text-red-500">{{ $message }}</p>
            @enderror
            <div class="flex flex-col">
                <input type="text-area" id="about" name="about" value="{{ old('about') }}"
                    placeholder="about ..." class="border-none py-5 px-8 rounded-xl">
                @error('about')
                    <p class="text-red-500">{{ $message }}</p>
                @enderror
            </div>
            <input type="submit" class="p-2 bg-[#3465f8] font-medium rounded-lg" value="Register your Profile">
        </form>
    @endif
@endsection
