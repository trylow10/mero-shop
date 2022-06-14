<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

        <!--  -->
        <div class="flex flex-wrap">

            <div class="w-half md:w-1/2 xl:w-1/3 p-6 d-count">
                <!--Metric Card-->
                <div class="border-b-4 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Total Users</h2>
                            <p class="font-bold text-3xl">{{ $userCount }}</p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-half md:w-1/2 xl:w-1/3 p-6 d-count">
                <!--Metric Card-->
                <div class="border-b-4 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Total Products</h2>
                            <p class="font-bold text-3xl">{{ $productCount }}</p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
            <div class="w-half md:w-1/2 xl:w-1/3 p-6 d-count">
                <!--Metric Card-->
                <div class="border-b-4 rounded-lg shadow-xl p-5">
                    <div class="flex flex-row items-center">
                        <div class="flex-1 text-right md:text-center">
                            <h2 class="font-bold uppercase text-gray-600">Total Order</h2>
                            <p class="font-bold text-3xl">{{ $purchaseCount }}</p>
                        </div>
                    </div>
                </div>
                <!--/Metric Card-->
            </div>
        </div>
        <!--  -->
    </x-slot>
</x-app-layout>
