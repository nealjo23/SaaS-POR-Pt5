@extends('layouts.app')

@section('content')
<div class="flex items-center grid grid-cols-1 md:grid-cols-1 gap-4 lg:gap-6 mt-4">

    <a href="/books" class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="flex items-center">
            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                {{--  icon from here: https://www.svgrepo.com/svg/532906/book-open  colours:e4861b  faf1eb --}}
                <svg width="64px" height="64px" viewBox="-8.88 -8.88 41.76 41.76" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-8.88" y="-8.88" width="41.76" height="41.76" rx="20.88" fill="#faf1eb" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M12 10.4V20M12 10.4C12 8.15979 12 7.03969 11.564 6.18404C11.1805 5.43139 10.5686 4.81947 9.81596 4.43597C8.96031 4 7.84021 4 5.6 4H4.6C4.03995 4 3.75992 4 3.54601 4.10899C3.35785 4.20487 3.20487 4.35785 3.10899 4.54601C3 4.75992 3 5.03995 3 5.6V16.4C3 16.9601 3 17.2401 3.10899 17.454C3.20487 17.6422 3.35785 17.7951 3.54601 17.891C3.75992 18 4.03995 18 4.6 18H7.54668C8.08687 18 8.35696 18 8.61814 18.0466C8.84995 18.0879 9.0761 18.1563 9.29191 18.2506C9.53504 18.3567 9.75977 18.5065 10.2092 18.8062L12 20M12 10.4C12 8.15979 12 7.03969 12.436 6.18404C12.8195 5.43139 13.4314 4.81947 14.184 4.43597C15.0397 4 16.1598 4 18.4 4H19.4C19.9601 4 20.2401 4 20.454 4.10899C20.6422 4.20487 20.7951 4.35785 20.891 4.54601C21 4.75992 21 5.03995 21 5.6V16.4C21 16.9601 21 17.2401 20.891 17.454C20.7951 17.6422 20.6422 17.7951 20.454 17.891C20.2401 18 19.9601 18 19.4 18H16.4533C15.9131 18 15.643 18 15.3819 18.0466C15.15 18.0879 14.9239 18.1563 14.7081 18.2506C14.465 18.3567 14.2402 18.5065 13.7908 18.8062L12 20" stroke="#e4861b" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
            </div>
            <div class="ml-4">
                <h2 class="text-l font-semibold text-gray-900 dark:text-white">Book Management</h2>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
            </svg>
        </div>
    </a>

    <a href="#" class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="flex items-center">
            {{--  icon from here: https://www.svgrepo.com/svg/326743/person-outline  --}}
            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                <svg width="64px" height="64px" viewBox="-179.2 -179.2 870.40 870.40" xmlns="http://www.w3.org/2000/svg" fill="#e4861b"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-179.2" y="-179.2" width="870.40" height="870.40" rx="435.2" fill="#faf1eb" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><title>ionicons-v5-j</title><path d="M344,144c-3.92,52.87-44,96-88,96s-84.15-43.12-88-96c-4-55,35-96,88-96S348,90,344,144Z" style="fill:none;stroke:#e4861b;stroke-linecap:round;stroke-linejoin:round;stroke-width:32px"></path><path d="M256,304c-87,0-175.3,48-191.64,138.6C62.39,453.52,68.57,464,80,464H432c11.44,0,17.62-10.48,15.65-21.4C431.3,352,343,304,256,304Z" style="fill:none;stroke:#e4861b;stroke-miterlimit:10;stroke-width:32px"></path></g></svg>
            </div>
            <div class="ml-4">
                <h2 class="text-l font-semibold text-gray-900 dark:text-white">Author Management</h2>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
            </svg>
        </div>
    </a>

    <a href="#" class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        <div class="flex items-center">
            {{--  icon from here: https://www.svgrepo.com/svg/533473/buildings  --}}
            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                <svg width="64px" height="64px" viewBox="-8.64 -8.64 41.28 41.28" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-8.64" y="-8.64" width="41.28" height="41.28" rx="20.64" fill="#faf1eb" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 21H2C2 21.5523 2.44772 22 3 22V21ZM21 21V22C21.5523 22 22 21.5523 22 21H21ZM6 6C5.44772 6 5 6.44772 5 7C5 7.55228 5.44772 8 6 8V6ZM7 8C7.55228 8 8 7.55228 8 7C8 6.44772 7.55228 6 7 6V8ZM11 6C10.4477 6 10 6.44772 10 7C10 7.55228 10.4477 8 11 8V6ZM12 8C12.5523 8 13 7.55228 13 7C13 6.44772 12.5523 6 12 6V8ZM6 9C5.44772 9 5 9.44772 5 10C5 10.5523 5.44772 11 6 11V9ZM7 11C7.55228 11 8 10.5523 8 10C8 9.44772 7.55228 9 7 9V11ZM11 9C10.4477 9 10 9.44772 10 10C10 10.5523 10.4477 11 11 11V9ZM12 11C12.5523 11 13 10.5523 13 10C13 9.44772 12.5523 9 12 9V11ZM6 12C5.44772 12 5 12.4477 5 13C5 13.5523 5.44772 14 6 14V12ZM7 14C7.55228 14 8 13.5523 8 13C8 12.4477 7.55228 12 7 12V14ZM11 12C10.4477 12 10 12.4477 10 13C10 13.5523 10.4477 14 11 14V12ZM12 14C12.5523 14 13 13.5523 13 13C13 12.4477 12.5523 12 12 12V14ZM11 21V22H12V21H11ZM7 21H6V22H7V21ZM18 10C17.4477 10 17 10.4477 17 11C17 11.5523 17.4477 12 18 12V10ZM18.01 12C18.5623 12 19.01 11.5523 19.01 11C19.01 10.4477 18.5623 10 18.01 10V12ZM18 13C17.4477 13 17 13.4477 17 14C17 14.5523 17.4477 15 18 15V13ZM18.01 15C18.5623 15 19.01 14.5523 19.01 14C19.01 13.4477 18.5623 13 18.01 13V15ZM18 16C17.4477 16 17 16.4477 17 17C17 17.5523 17.4477 18 18 18V16ZM18.01 18C18.5623 18 19.01 17.5523 19.01 17C19.01 16.4477 18.5623 16 18.01 16V18ZM20.891 7.54601L20 8L20.891 7.54601ZM20.454 7.10899L20 8L20.454 7.10899ZM14.454 3.10899L14 4L14.454 3.10899ZM14.891 3.54601L14 4L14.891 3.54601ZM3.10899 3.54601L4 4L3.10899 3.54601ZM3.54601 3.10899L4 4L3.54601 3.10899ZM2 4.6V21H4V4.6H2ZM4.6 4H13.4V2H4.6V4ZM14 4.6V7H16V4.6H14ZM14 7V21H16V7H14ZM3 22H15V20H3V22ZM15 22H21V20H15V22ZM20 8.6V21H22V8.6H20ZM15 8H19.4V6H15V8ZM6 8H7V6H6V8ZM11 8H12V6H11V8ZM6 11H7V9H6V11ZM11 11H12V9H11V11ZM6 14H7V12H6V14ZM11 14H12V12H11V14ZM10 18V21H12V18H10ZM11 20H7V22H11V20ZM8 21V18H6V21H8ZM9 17C9.55228 17 10 17.4477 10 18H12C12 16.3431 10.6569 15 9 15V17ZM9 15C7.34315 15 6 16.3431 6 18H8C8 17.4477 8.44772 17 9 17V15ZM18 12H18.01V10H18V12ZM18 15H18.01V13H18V15ZM18 18H18.01V16H18V18ZM22 8.6C22 8.33647 22.0008 8.07869 21.9831 7.86177C21.9644 7.63318 21.9203 7.36344 21.782 7.09202L20 8C19.9707 7.94249 19.9811 7.91972 19.9897 8.02463C19.9992 8.14122 20 8.30347 20 8.6H22ZM19.4 8C19.6965 8 19.8588 8.00078 19.9754 8.0103C20.0803 8.01887 20.0575 8.0293 20 8L20.908 6.21799C20.6366 6.07969 20.3668 6.03562 20.1382 6.01695C19.9213 5.99922 19.6635 6 19.4 6V8ZM21.782 7.09202C21.5903 6.7157 21.2843 6.40973 20.908 6.21799L20 8L21.782 7.09202ZM13.4 4C13.6965 4 13.8588 4.00078 13.9754 4.0103C14.0803 4.01887 14.0575 4.0293 14 4L14.908 2.21799C14.6366 2.07969 14.3668 2.03562 14.1382 2.01695C13.9213 1.99922 13.6635 2 13.4 2V4ZM16 4.6C16 4.33647 16.0008 4.07869 15.9831 3.86177C15.9644 3.63318 15.9203 3.36344 15.782 3.09202L14 4C13.9707 3.94249 13.9811 3.91972 13.9897 4.02463C13.9992 4.14122 14 4.30347 14 4.6H16ZM14 4L15.782 3.09202C15.5903 2.7157 15.2843 2.40973 14.908 2.21799L14 4ZM4 4.6C4 4.30347 4.00078 4.14122 4.0103 4.02463C4.01887 3.91972 4.0293 3.94249 4 4L2.21799 3.09202C2.07969 3.36344 2.03562 3.63318 2.01695 3.86177C1.99922 4.07869 2 4.33647 2 4.6H4ZM4.6 2C4.33647 2 4.07869 1.99922 3.86177 2.01695C3.63318 2.03562 3.36344 2.07969 3.09202 2.21799L4 4C3.94249 4.0293 3.91972 4.01887 4.02463 4.0103C4.14122 4.00078 4.30347 4 4.6 4V2ZM4 4L3.09202 2.21799C2.71569 2.40973 2.40973 2.71569 2.21799 3.09202L4 4Z" fill="#e4861b"></path> </g></svg>
            </div>
            <div class="ml-4">
                <h2 class="text-l font-semibold text-gray-900 dark:text-white">Publisher Management</h2>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
            </svg>
        </div>
    </a>

    <a href="/genres" class="p-6 bg-white dark:bg-gray-800/50 dark:bg-gradient-to-bl from-gray-700/50 via-transparent dark:ring-1 dark:ring-inset dark:ring-white/5 rounded-lg shadow-2xl shadow-gray-500/20 dark:shadow-none flex motion-safe:hover:scale-[1.01] transition-all duration-250 focus:outline focus:outline-2 focus:outline-red-500">
        {{--  icon from here: https://www.svgrepo.com/svg/527221/masks --}}
        <div class="flex items-center">
            <div class="h-16 w-16 bg-red-50 dark:bg-red-800/20 flex items-center justify-center rounded-full">
                <svg width="64px" height="64px" viewBox="-8.88 -8.88 41.76 41.76" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"><rect x="-8.88" y="-8.88" width="41.76" height="41.76" rx="20.88" fill="#faf1eb" strokewidth="0"></rect></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M16.7582 12.6766L15.9131 9.37926C15.4725 7.66038 15.2522 6.80094 14.677 6.36888C14.4841 6.22403 14.268 6.11656 14.0388 6.05159C13.3551 5.85777 12.5782 6.22163 11.0242 6.94934C9.87347 7.48822 9.29811 7.75765 8.69774 7.94822C8.48901 8.01448 8.27824 8.07352 8.06578 8.12524C7.4547 8.27402 6.82756 8.34142 5.57328 8.47622C3.87945 8.65827 3.03253 8.74929 2.53319 9.27447C2.36579 9.45054 2.22999 9.6566 2.13226 9.88284C1.84073 10.5577 2.06102 11.4171 2.50159 13.136L3.34673 16.4334C4.34019 20.3093 7.64328 21.5286 9.86292 21.9058C10.5401 22.0208 10.8787 22.0784 11.907 21.7903C12.9353 21.5023 13.201 21.2755 13.7324 20.8219C15.4742 19.335 17.7517 16.5526 16.7582 12.6766Z" stroke="#e4861b" stroke-width="1.752"></path> <path opacity="0.5" d="M16.5 17.221C18.2412 16.4706 19.9791 15.0638 20.6533 12.4334L21.4984 9.13602C21.939 7.41713 22.1593 6.55769 21.8678 5.88284C21.77 5.6566 21.6342 5.45054 21.4668 5.27447C20.9675 4.74929 20.1206 4.65827 18.4267 4.47622C17.1725 4.34142 16.5453 4.27402 15.9342 4.12524C15.7218 4.07352 15.511 4.01448 15.3023 3.94822C14.7019 3.75765 14.1266 3.48822 12.9758 2.94934C11.4219 2.22163 10.6449 1.85777 9.96126 2.05159C9.73208 2.11656 9.51592 2.22403 9.32307 2.36888C8.74783 2.80094 8.52754 3.66038 8.08698 5.37926L7.38745 8.10846" stroke="#e4861b" stroke-width="1.752"></path> <path d="M5.25882 13.2955C5.31893 12.6763 5.77997 12.1206 6.44889 11.9414C7.11781 11.7621 7.79491 12.0128 8.1566 12.5191" stroke="#e4861b" stroke-width="1.752" stroke-linecap="round"></path> <path opacity="0.5" d="M19.1797 8.93565C19.1195 8.3164 18.6585 7.76073 17.9896 7.5815C17.3207 7.40226 16.6436 7.65296 16.2819 8.1592" stroke="#e4861b" stroke-width="1.752" stroke-linecap="round"></path> <path d="M11.0547 11.7423C11.1148 11.123 11.5759 10.5674 12.2448 10.3881C12.9137 10.2089 13.5908 10.4596 13.9525 10.9658" stroke="#e4861b" stroke-width="1.752" stroke-linecap="round"></path> <path opacity="0.5" d="M11.0963 7.04186C10.8555 7.37889 10.3871 7.4569 10.05 7.21611C9.71299 6.97531 9.63498 6.50689 9.87578 6.16986L11.0963 7.04186ZM11.9996 6.75261C11.6209 6.65113 11.2692 6.79987 11.0963 7.04186L9.87578 6.16986C10.4263 5.39938 11.4287 5.04672 12.3879 5.30372L11.9996 6.75261ZM12.4781 7.06543C12.3675 6.92277 12.2041 6.80739 11.9996 6.75261L12.3879 5.30372C12.9124 5.44427 13.3545 5.74776 13.6635 6.14629L12.4781 7.06543Z" fill="#e4861b"></path> <path d="M13.2007 16.231C13.2007 16.231 12.1758 15.4703 10.3884 15.9492C8.60094 16.4282 8.09372 17.5994 8.09372 17.5994" stroke="#e4861b" stroke-width="1.752" stroke-linecap="round"></path> </g></svg>
            </div>
            <div class="ml-4">
                <h2 class="text-l font-semibold text-gray-900 dark:text-white">Genre Management</h2>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                 class="self-center shrink-0 stroke-red-500 w-6 h-6 mx-6">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M4.5 12h15m0 0l-6.75-6.75M19.5 12l-6.75 6.75"/>
            </svg>
        </div>
    </a>


</div>
@endsection
