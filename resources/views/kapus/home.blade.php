<?php session()->put('flag', 0); ?>
@extends('layouts.kapusPartial.master')

@section('title')
Dashboard
<!-- Main content -->
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
              <div class="inner">
                <h3>{{DB::table('cabang')->count()}}</h3>

                <p>Cabang</p>
              </div>
              <div class="icon">
                <i class="ion fa-map-pin"></i>
              </div>
            </div>
          </div>

          <!-- Small boxes (Stat box) -->
          <div class="row">
            <div class="col-lg-3 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>{{DB::table('alat')->count()}}</h3>

                  <p>Alat</p>
                </div>
                <div class="icon">
                  <i class="ion fa-gavel"></i>
                </div>
              </div>
            </div>
@endsection

@section('content')
@endsection
