<?php session()->put('flag', 0); ?>
@extends('layouts.PenelitiPartial.master')

@section('title')
Dashboard
<!-- Main content -->
<section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <h3>150</h3>

                <p>User Registration</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
              <div class="inner">
                <h3>53<sup style="font-size: 20px"></sup></h3>

                <p>Sales</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
          </div>

@endsection

@section('content')
{{--<div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">List User</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
              <i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="box-body">
          Start creating your amazing application!
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          Footer
        </div>
        <!-- /.box-footer-->
</div>--}}
<!-- TABLE: LIST USER -->
<div class="box box-info">
        <div class="box-header with-border">
          <h3 class="box-title">List User</h3>

          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
            </button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
          <div class="table-responsive">
            <table class="table no-margin">
              <thead>
              <tr>
                <th>User ID</th>
                <th>Username</th>
                <th>Category</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Create At</th>
                <th>Update At</th>
                <th>Option</th>
              </tr>
              </thead>
              <tbody>
              <tr>
                <td><a href="pages/examples/invoice.html">OR9842</a></td>
                <td>Call of Duty IV</td>
                <td><span class="label label-success">Shipped</span></td>
                <td>
                    <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                </td>
                <td>Call of Duty IV</td>
                <td>Call of Duty IV</td>
                <td>Call of Duty IV</td>
                <td>Call of Duty IV</td>
                <td><span class="label label-info">Edit</span> <span class="label label-danger">Delete</span></td>
              </tr>
              </tbody>
            </table>
          </div>
          <!-- /.table-responsive -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">
          <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Users</a>
        </div>
        <!-- /.box-footer -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
@endsection
