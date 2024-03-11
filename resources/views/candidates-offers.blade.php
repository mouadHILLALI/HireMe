@extends('layouts.mynav')
@section('home')
    <section class="bg-white dark:bg-gray-900">
        <div class="container px-6 py-10 mx-auto">
            <div class="text-center">
                <h1 class="text-2xl font-semibold text-gray-800 capitalize lg:text-3xl dark:text-white">Candidates :</h1>

                <p class="max-w-lg mx-auto mt-4 text-gray-500">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure veritatis sint autem nesciunt, laudantium
                    quia tempore delect
                </p>
            </div>
            <div class="grid grid-cols-1 gap-8 mt-8 lg:grid-cols-2">
            @foreach ($candidates as $candidate)     
            
                <div>
                    <img class="relative z-10 object-cover w-full rounded-md h-96"
                        src="{{asset('images/'.$candidate->candidate->photo)}}"
                        alt="...">

                    <div class="relative z-20 max-w-lg p-6 mx-auto -mt-20 bg-white rounded-md shadow dark:bg-gray-900">
                        <a  class="font-semibold text-gray-800 hover:underline dark:text-white md:text-xl">
                           {{$candidate->candidate->name}}
                        </a>
                        <p class="mt-3 text-sm text-gray-500 dark:text-gray-300 md:text-sm">
                            {{$candidate->candidate->about}}
                        </p>
                        <p class="mt-3 text-sm text-blue-500">{{$candidate->candidate->address}}</p>
                    </div>
                </div>
           
            @endforeach
        </div>
        </div>
    </section>
@endsection
