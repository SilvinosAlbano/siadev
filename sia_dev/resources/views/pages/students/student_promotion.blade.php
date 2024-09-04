@extends('layouts.app')
@section('title', 'Students')
@section('content')
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Students</h3>
        <ul>
            <li>
                <a href="/home">Home</a>
            </li>
            <li>Student Promotion</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <!-- Student Promotion Area Start Here -->
    <div class="card height-auto">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Search Student Promotion</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">...</a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <form class="new-added-form">
                <div class="row">
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Current Session *</label>
                        <select class="select2">
                            <option value="">2017-2018</option>
                            <option value="1">2018-2019</option>
                            <option value="2">2015-2016</option>
                            <option value="3">2014-2015</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Promote Session *</label>
                        <select class="select2">
                            <option value="">2017-2018</option>
                            <option value="1">2018-2019</option>
                            <option value="2">2015-2016</option>
                            <option value="3">2014-2015</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Promotion From Class *</label>
                        <select class="select2">
                            <option value="">Please Select *</option>
                            <option value="1">Play</option>
                            <option value="2">Nursery</option>
                            <option value="3">One</option>
                            <option value="3">Two</option>
                            <option value="3">Three</option>
                            <option value="3">Four</option>
                            <option value="3">Five</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-lg-6 col-12 form-group">
                        <label>Promotion To Class *</label>
                        <select class="select2">
                            <option value="">Please Select *</option>
                            <option value="1">Play</option>
                            <option value="2">Nursery</option>
                            <option value="3">One</option>
                            <option value="3">Two</option>
                            <option value="3">Three</option>
                            <option value="3">Four</option>
                            <option value="3">Five</option>
                        </select>
                    </div>
                    <div class="col-12 form-group mg-t-8">
                        <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                        <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Student Promotion Area End Here -->
@endsection
