<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<div class="page-content">
    <!--section-->
    <div class="section mt-0">
        <div class="breadcrumbs-wrap">
            <div class="container">
                <div class="breadcrumbs">
                    <a href="index.html">Home</a>
                    <a href="services.html">Services</a>
                    <span>Prices</span>
                </div>
            </div>
        </div>
    </div>
    <!--//section-->
    <!--section prices-->
    <div class="section page-content-first">
        <div class="container">
            <div class="text-center mb-2 mb-md-3 mb-lg-4">
                <div class="h-sub theme-color">Our clinic fees</div>
                <h1>Dental Service Prices</h1>
                <div class="h-decor"></div>
            </div>
        </div>
        <div class="container">
            <div class="text-center mb-3 mb-md-4 max-900">
                <p>This chart is for example comparison purposes ONLY. Fees are subject to change. Each patient’s total cost of care will vary, and your provider will advise you on the best procedures for your needs.</p>
            </div>
            <div class="nav nav-pills justify-content-center" role="tablist">
                <a class="nav-link active" data-toggle="pill" href="#tab-A" role="tab" aria-expanded="true">Examinations / Cleaning</a>
                <a class="nav-link" data-toggle="pill" href="#tab-B" role="tab" aria-expanded="false">Digital X-Ray</a>
                <a class="nav-link" data-toggle="pill" href="#tab-C" role="tab" aria-expanded="false">Filling / Aesthetic</a>
                <a class="nav-link" data-toggle="pill" href="#tab-D" role="tab" aria-expanded="false">Teeth Whitening</a>
                <a class="nav-link" data-toggle="pill" href="#tab-E" role="tab" aria-expanded="false">Endodontic Dentistry</a>
                <a class="nav-link" data-toggle="pill" href="#tab-F" role="tab" aria-expanded="false">Periodontic Dentistry</a>
                <a class="nav-link" data-toggle="pill" href="#tab-G" role="tab" aria-expanded="false">Orthodontics</a>
            </div>
            <div id="tab-content" class="tab-content mt-3 mt-md-4">
                <div id="tab-A" class="tab-pane fade show active" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">General Examination / General Consultation / Treatment Plan</td>
                                    <td>Visit</td>
                                    <td> Free</td>
                                    <td> 1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>40</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>45</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning Under L.A Quarter</td>
                                    <td>Quarter</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-B" class="tab-pane fade" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table table-bordered price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>40</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>45</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning Under L.A Quarter</td>
                                    <td>Quarter</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">General Examination / General Consultation / Treatment Plan</td>
                                    <td>Visit</td>
                                    <td> Free</td>
                                    <td> 1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-C" class="tab-pane fade" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table table-bordered price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning Under L.A Quarter</td>
                                    <td>Quarter</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">General Examination / General Consultation / Treatment Plan</td>
                                    <td>Visit</td>
                                    <td> Free</td>
                                    <td> 1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>40</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-D" class="tab-pane fade" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table table-bordered price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>45</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning Under L.A Quarter</td>
                                    <td>Quarter</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">General Examination / General Consultation / Treatment Plan</td>
                                    <td>Visit</td>
                                    <td> Free</td>
                                    <td> 1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-E" class="tab-pane fade" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table table-bordered price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning Under L.A Quarter</td>
                                    <td>Quarter</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">General Examination / General Consultation / Treatment Plan</td>
                                    <td>Visit</td>
                                    <td> Free</td>
                                    <td> 1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>

                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>

                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-F" class="tab-pane fade" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table table-bordered price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>40</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>45</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning Under L.A Quarter</td>
                                    <td>Quarter</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">General Examination / General Consultation / Treatment Plan</td>
                                    <td>Visit</td>
                                    <td> Free</td>
                                    <td> 1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with Senior Dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tab-G" class="tab-pane fade" role="tabpanel">
                    <div class="table-scroll">
                        <div class="table-wrap">
                            <table class="table table-bordered price-table js-fixed-table">
                                <tr>
                                    <th class="fixed-side">Treatment Types</th>
                                    <th>Unit</th>
                                    <th>Price(USD) </th>
                                    <th># of Visits</th>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Specialized Consultation and Treatment Plan</td>
                                    <td>Visit</td>
                                    <td>15 - 25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Normal)</td>
                                    <td>U&amp;L</td>
                                    <td>25</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Medium)</td>
                                    <td>U&amp;L</td>
                                    <td>30</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="fixed-side">Cleaning &amp; Polishing with General dentist (Heavy)</td>
                                    <td>U&amp;L</td>
                                    <td>35</td>
                                    <td>1</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <p class="mt-2 p-sm">* All prices below are given in US Dollars</p>
        </div>
        <!--//section-->
    </div>
    <!--//section prices-->
    <!--section special offers-->
    <div class="section" id="specialOffer">
        <div class="container">
            <div class="title-wrap text-center">
                <div class="h-sub theme-color">For Our Dear Clients</div>
                <h2 class="h1">Special Offers</h2>
                <div class="h-decor"></div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="special-card">
                        <div class="special-card-photo">
                            <img src="images/content/special-photo-01.jpg" alt="">
                        </div>
                        <div class="special-card-caption text-left">
                            <div class="special-card-txt1">New Patient</div>
                            <div class="special-card-txt2">Offer</div>
                            <div class="special-card-txt3">Full Consultation
                                <br> Scale & Polish</div>
                            <div><a href="schedule.html" class="btn"><i class="icon-right-arrow"></i><span>Schedule</span><i class="icon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="special-card">
                        <div class="special-card-photo">
                            <img src="images/content/special-photo-02.jpg" alt="">
                        </div>
                        <div class="special-card-caption text-left">
                            <div class="special-card-txt1">Free</div>
                            <div class="special-card-txt2">Consultation</div>
                            <div class="special-card-txt3">Contact us to find out more about this offer</div>
                            <div><a href="contact.html" class="btn"><i class="icon-right-arrow"></i><span>Contact us</span><i class="icon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="special-card">
                        <div class="special-card-photo">
                            <img src="images/content/special-photo-03.jpg" alt="">
                        </div>
                        <div class="special-card-caption text-left">
                            <div class="special-card-txt1">Whitening</div>
                            <div class="special-card-txt2">Laser Teeth</div>
                            <div class="special-card-txt3">
                                Tooth whitening<br>and Home Bleaching</div>
                            <div><a href="services.html" class="btn"><i class="icon-right-arrow"></i><span>Know more</span><i class="icon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="special-card">
                        <div class="special-card-photo">
                            <img src="images/content/special-photo-04.jpg" alt="">
                        </div>
                        <div class="special-card-caption text-left">
                            <div class="special-card-txt1">Porcelain</div>
                            <div class="special-card-txt2">Veneer</div>
                            <div class="special-card-txt3">6 Teeth or more in the same
                                <br>jaw, upper or lower front</div>
                            <div><a href="service-page.html" class="btn"><i class="icon-right-arrow"></i><span>Know more</span><i class="icon-right-arrow"></i></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--//section special offers-->
</div>
