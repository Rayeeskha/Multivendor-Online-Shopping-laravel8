@extends('admin/layout')
@section('page_title', 'Dashboard')
@section('container')

<div class="row">
 <div class="col-xl-3 col-sm-6 col-12">
    <div class="dashboard-summery-one mg-b-20">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="item-icon bg-light-green ">
                    <i class="flaticon-classmates text-green"></i>
                </div>
            </div>
            <div class="col-6">
                <div class="item-content">
                    <div class="item-title"> Products</div>
                    <div class="item-number"><span class="counter" data-num="{{count($products)}}">{{count($products)}}</span></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
    <div class="dashboard-summery-one mg-b-20">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="item-icon bg-light-blue">
                    <i class="far fa-bell"></i>
                </div>
            </div>
            <div class="col-6">
                <div class="item-content">
                    <div class="item-title">Orders</div>
                    <div class="item-number">
                        <?php $orders =  get_all_orders();
                            if($orders):
                        ?>

                        <span class="counter" data-num="<?= count($orders); ?>"><?= count($orders); ?></span>
                        <?php else:endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
    <div class="dashboard-summery-one mg-b-20">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="item-icon bg-light-yellow">
                    <i class="flaticon-couple text-orange"></i>
                </div>
            </div>
            <div class="col-6">
                <div class="item-content">
                    <div class="item-title">Customer</div>
                    <div class="item-number">
                        @if($customers)

                        <span class="counter" data-num="{{count($customers)}}">{{count($customers)}}</span>
                        @else
                        <span class="counter" data-num="0">0</span>
                        
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-3 col-sm-6 col-12">
    <div class="dashboard-summery-one mg-b-20">
        <div class="row align-items-center">
            <div class="col-6">
                <div class="item-icon bg-light-red">
                    <i class="flaticon-money text-red"></i>
                </div>
            </div>
            <div class="col-6">
                <div class="item-content">
                    <div class="item-title">Earnings</div>
                    <div class="item-number">
                        @if($income)
                        <span class="counter" data-num="{{$income}}">{{number_format($income)}}</span>
                        @else 
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Dashboard summery End Here -->
<!-- Dashboard Content Start Here -->
<div class="row gutters-20">
<div class="col-12 col-xl-8 col-6-xxxl">
    <div class="card dashboard-card-one pd-b-20">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Order Charts</h3>
                </div>
            </div>
            <div class="earning-chart-wrap">
               <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-xl-4 col-3-xxxl">
    <div class="card dashboard-card-two pd-b-20">
        <div class="card-body">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Expenses</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <div class="expense-report">
                <div class="monthly-expense pseudo-bg-Aquamarine">
                    <div class="expense-date">June <?= date('y'); ?></div>
                    <div class="expense-amount"><span>$</span> 15,000</div>
                </div>
                <div class="monthly-expense pseudo-bg-blue">
                    <div class="expense-date">May<?= date('y'); ?></div>
                    <div class="expense-amount"><span>$</span> 10,000</div>
                </div>
                <div class="monthly-expense pseudo-bg-yellow">
                    <div class="expense-date">July<?= date('y'); ?></div>
                    <div class="expense-amount"><span>$</span> 8,000</div>
                </div>
            </div>
            <div class="expense-chart-wrap">
                <canvas id="expense-bar-chart" width="100" height="300"></canvas>
            </div>
        </div>
    </div>
</div>
<div class="col-12 col-xl-12 col-3-xxxl">
    <div class="card dashboard-card-three pd-b-20">
        <div class="card-body">
            
            <div class="doughnut-chart-wrap">
                <!-- <canvas id="student-doughnut-chart" width="100" height="300"></canvas> -->
                <div id="sellerandbuyeraccount" style="width:300px;height: 320px"></div>
            </div>
            
        </div>
    </div>
</div>

<div class="col-lg-12 col-xl-12 col-4-xxxl">
    <div class="card dashboard-card-five pd-b-20">
        <div class="card-body pd-b-14">
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>Website Traffic</h3>
                </div>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                        aria-expanded="false">...</a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-times text-orange-red"></i>Close</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                        <a class="dropdown-item" href="#"><i
                                class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                    </div>
                </div>
            </div>
            <h6 class="traffic-title">Unique Visitors</h6>
            <div class="traffic-number">2,590</div>
            <div class="traffic-bar">
                <div class="direct" data-toggle="tooltip" data-placement="top" title="Direct">
                </div>
                <div class="search" data-toggle="tooltip" data-placement="top" title="Search">
                </div>
                <div class="referrals" data-toggle="tooltip" data-placement="top" title="Referrals">
                </div>
                <div class="social" data-toggle="tooltip" data-placement="top" title="Social">
                </div>
            </div>
            <div class="traffic-table table-responsive">
                <table class="table">
                    <tbody>
                        <tr>
                            <td class="t-title pseudo-bg-Aquamarine">Direct</td>
                            <td>12,890</td>
                            <td>50%</td>
                        </tr>
                        <tr>
                            <td class="t-title pseudo-bg-blue">Search</td>
                            <td>7,245</td>
                            <td>27%</td>
                        </tr>
                        <tr>
                            <td class="t-title pseudo-bg-yellow">Referrals</td>
                            <td>4,256</td>
                            <td>8%</td>
                        </tr>
                        <tr>
                            <td class="t-title pseudo-bg-red">Social</td>
                            <td>500</td>
                            <td>7%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Dashboard Content End Here -->
<!-- Social Media Start Here -->
<div class="row gutters-20">
<div class="col-lg-3 col-sm-6 col-12">
    <div class="card dashboard-card-seven">
        <div class="social-media bg-fb hover-fb">
            <div class="media media-none--lg">
                <div class="social-icon">
                    <i class="fab fa-facebook-f"></i>
                </div>
                <div class="media-body space-sm">
                    <h6 class="item-title">Like us on facebook</h6>
                </div>
            </div>
            <div class="social-like">30,000</div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="card dashboard-card-seven">
        <div class="social-media bg-twitter hover-twitter">
            <div class="media media-none--lg">
                    <div class="social-icon">
                    <i class="fab fa-twitter"></i>
                    </div>
                    <div class="media-body space-sm">
                        <h6 class="item-title">Follow us on twitter</h6>
                    </div>
            </div>
            <div class="social-like">1,11,000</div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="card dashboard-card-seven">
        <div class="social-media bg-gplus hover-gplus">
            <div class="media media-none--lg">
                <div class="social-icon">
                    <i class="fab fa-google-plus-g"></i>
                </div>
                <div class="media-body space-sm">
                    <h6 class="item-title">Follow us on googleplus</h6>
                </div>
            </div>
            <div class="social-like">19,000</div>
        </div>
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-12">
    <div class="card dashboard-card-seven">
        <div class="social-media bg-linkedin hover-linked">
            <div class="media media-none--lg">
                <div class="social-icon">
                <i class="fab fa-linkedin-in"></i>
                </div>
                <div class="media-body space-sm">
                    <h6 class="item-title">Follow us on linked</h6>
                </div>
            </div>
            <div class="social-like">45,000</div>
        </div>
    </div>
</div>

@endsection
