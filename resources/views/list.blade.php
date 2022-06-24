{{-- <x-app-layout>
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
                            <p class="font-bold text-3xl">{{ $Count }}</p>
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
</x-app-layout> --}}
@extends('adminlte::page')

@section('title', 'Dashboard | Lara Admin')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>{{ $userCount }}</h3>
                    <p>Users</p>

                    {{-- <h3>{{ $productCount }}</h3>
                    <p>Products</p>

                    <h3>{{ $purchaseCount }}</h3>

                    <p>Purchase</p> --}}
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
    </div>
    <div class="box-body">
        <table id="laravel_datatable" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    </div>
    <!-- /.box -->
    </div>
    <!-- /.col -->
    </div>
@stop
@section('js')
    <script>
        $(document).ready(function() {
            $('#laravel_datatable').DataTable();
        });
    </script>
@stop
