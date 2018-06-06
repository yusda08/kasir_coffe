<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$a = $this->session->userdata('is_login');
echo $javasc;
?>
<div class="row">
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-alert-circled"></i></span>
            <div class="info-box-content">
                <span class="text-center info-box-text">Pendapatan Hari</span>
                <br>
                <span class="text-center info-box-number">Rp. <?= number_format($ttl_hr,2,',','.');?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-alert-circled"></i></span>
            <div class="info-box-content">
                <span class="text-center info-box-text">Pengeluaran Hari Ini</span>
                <br>
                <span class="text-center info-box-number">Rp. <?= number_format($ttl_pengeluaran_hr,2,',','.');?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-alert-circled"></i></span>
            <div class="info-box-content">
                <span class="text-center info-box-text">Pendapatan Bersih Hari Ini</span>
                <br>
                <span class="text-center info-box-number">Rp. <?= number_format($ttl_hr-$ttl_pengeluaran_hr,2,',','.');?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-alert"></i></span>
            <div class="info-box-content">
                <span class="text-center info-box-text">Total Pendapatan</span>
                <br>
                <span class="text-center info-box-number">Rp. <?= number_format($total,2,',','.');?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-alert"></i></span>
            <div class="info-box-content">
                <span class="text-center info-box-text">Total Pengeluaran</span>
                <br>
                <span class="text-center info-box-number">Rp. <?= number_format($ttl_pengeluaran,2,',','.');?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box">
            <span class="info-box-icon bg-gray"><i class="ion ion-alert"></i></span>
            <div class="info-box-content">
                <span class="text-center info-box-text">Total Pendapatan Bersih</span>
                <br>
                <span class="text-center info-box-number">Rp. <?= number_format($total-$ttl_pengeluaran,2,',','.');?></span>
            </div>
        </div>
    </div>
</div>