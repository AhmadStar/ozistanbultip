<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

@if (count($sliders) > 0)
<!--section slider-->
    <div class="section mt-0">
        <div class="quickLinks-wrap js-quickLinks-wrap-d d-none d-lg-flex">
            <div class="quickLinks js-quickLinks">
                <div class="container">
                    <div class="row no-gutters">
                        <div class="col">
                            <a href="#" class="link">
                                <i class="icon-placeholder"></i><span>{{ __("Location")}}</span></a>
                            <div class="link-drop p-0">
                                <div id="googleMapDrop" class="google-map"></div>
                            </div>
                        </div>
                        <div class="col">
                            <a href="#" class="link">
                                <i class="icon-clock"></i><span>{{ __("Working Time")}}</span>
                            </a>
                            <div class="link-drop">
                                <h5 class="link-drop-title"><i class="icon-clock"></i>{{ __("Working Time")}}</h5>
                                <table class="row-table">
                                    <tr>
                                        <td><i>{{ __("Mon-Thu")}}</i></td>
                                        <td>08:00 - 20:00</td>
                                    </tr>
                                    <tr>
                                        <td><i>{{ __("Friday")}}</i></td>
                                        <td> 07:00 - 22:00</td>
                                    </tr>
                                    <tr>
                                        <td><i>{{ __("Saturday")}}</i></td>
                                        <td>08:00 - 18:00</td>
                                    </tr>
                                    <tr>
                                        <td><i>{{ __("Sunday")}}</i></td>
                                        <td>{{ __("Closed")}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <a href="#" class="link">
                                <i class="icon-pencil-writing"></i><span>{{ __("Request Form")}}</span>
                            </a>
                            <div class="link-drop">
                                <h5 class="link-drop-title"><i class="icon-pencil-writing"></i>{{ __("Request Form")}}</h5>
                                {!! Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'contact-form']) !!}
                                    <div class="successform contact-success-message">
                                        <p>{{ __("Your message was sent successfully!")}}</p>
                                    </div>
                                    <div class="errorform contact-error-message">
                                        <p>{{ __("Something went wrong, try refreshing and submitting the form again.")}}</p>
                                    </div>
                                    <div class="input-group">
                                        <span>
                                        <i class="icon-user"></i>
                                    </span>
                                        <input name="name" type="text" class="form-control" placeholder="{{ __("Name")}}" />
                                    </div>
                                    <div class="row row-sm-space mt-1">
                                        <div class="col">
                                            <div class="input-group">
                                                <span>
                                                <i class="icon-email2"></i>
                                            </span>
                                                <input name="email" type="text" class="form-control" placeholder="{{ __("Email")}}" />
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <span>
                                                <i class="icon-smartphone"></i>
                                            </span>
                                                <input name="phone" type="text" class="form-control" placeholder="{{ __("Your Phone")}}" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="selectWrapper input-group mt-1">
                                        <span>
                                        <i class="icon-tooth"></i>
                                    </span>
                                        <select name="service" class="form-control">
                                            <option selected="selected" disabled="disabled">{{ __("Select Service")}}</option>
                                            <option value="{{__("Cosmetic Dentistry")}}">{{__("Cosmetic Dentistry")}}</option>
                                            <option value="{{ __("General Dentistry")}}">{{ __("General Dentistry")}}</option>
                                            <option value="{{ __("Orthodontics")}}">{{ __("Orthodontics")}}</option>
                                            <option value="{{ __("Children`s Dentistry")}}">{{ __("Children`s Dentistry")}}</option>
                                            <option value="{{ __("Dental Implants")}}">{{ __("Dental Implants")}}</option>
                                            <option value="{{ __("Dental Emergency")}}">{{ __("Dental Emergency")}}</option>
                                        </select>
                                    </div>
                                    <div class="row row-sm-space mt-1">
                                        <div class="col-sm-6">
                                            <div class="input-group flex-nowrap">
                                                <span>
                                                    <i class="icon-calendar2"></i>
                                                </span>
                                                <div class="datepicker-wrap">
                                                    <input name="date" type="text" class="form-control datetimepicker" placeholder="{{__("Date")}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mt-1 mt-sm-0">
                                            <div class="input-group flex-nowrap">
                                                <span>
                                                        <i class="icon-clock"></i>
                                                </span>
                                                <div class="datepicker-wrap">
                                                    <input name="time" type="text" class="form-control timepicker" placeholder="{{ __("Time")}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-right mt-2">
                                        <button type="submit" class="btn btn-sm btn-hover-fill">{{ __("Request")}}</button>
                                    </div>
                            {!! Form::close() !!}
                            </div>
                        </div>
                        <div class="col">
                            <a href="#" class="link">
                                <i class="icon-calendar"></i><span>{{ __("Doctors Timetable")}}</span>
                            </a>
                            <div class="link-drop">
                                <h5 class="link-drop-title"><i class="icon-calendar"></i>{{ __("Doctors Timetable")}}</h5>
                                <p>{{ __("This simply works as a guide and helps you to connect with dentists of your choice.")}}
                                    {{ __("Please confirm the doctor’s availability before leaving your premises.")}}</p>
                                <p class="text-right"><a href="/{{ $lang }}/contact-us" class="btn btn-sm btn-hover-fill">{{ __("Details")}}</a></p>
                            </div>
                        </div>
                        <div class="col">
                            <a href="#" class="link">
                                <i class="icon-price-tag"></i><span>{{ __("Calculator")}}</span>
                            </a>
                            <div class="link-drop">
                                <h5 class="link-drop-title"><i class="icon-price-tag"></i>{{ __("Quick Pricing")}}</h5>
                                <table class="row-table">
                                    <tr>
                                        <td>{{ __("Initial Consultation")}}</td>
                                        <td>$10</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Dental check-up")}}</td>
                                        <td>$15</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Routine Exam (no xrays)")}}</td>
                                        <td>$50</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Simple Removal of a tooth")}}</td>
                                        <td>$122</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("Teeth cleaning")}}</td>
                                        <td>$50 - $75</td>
                                    </tr>
                                    <tr>
                                        <td>{{ __("X-ray image")}}</td>
                                        <td>$10</td>
                                    </tr>
                                </table>
                                <p class="text-right mt-15"><a href="/{{$lang}}/contact-us" class="btn btn-sm btn-hover-fill">{{ __("Calculator")}}</a><a href="/{{$lang}}/contact-us" class="btn btn-sm btn-hover-fill">{{ __("Details")}}</a></p>
                            </div>
                        </div>
                        <div class="col">
                            <a href="#" class="link">
                                <i class="icon-emergency-call"></i><span>{{ __("Emergency Case")}}</span></a>
                            <div class="link-drop">
                                <h5 class="link-drop-title"><i class="icon-emergency-call"></i>{{ __("Emergency Case")}}</h5>
                                <p>{{ __("Emergency dental care may be needed if you have had a blow to the face, lost a filling, or cracked a tooth.")}} </p>
                                <ul class="icn-list">
                                    <li><i class="icon-telephone"></i><span class="phone">{{ theme_option('phone1')}}<br>{{ theme_option('phone2')}}</span>
                                    </li>
                                    <li><i class="icon-black-envelope"></i><a href="mailto:{{ theme_option('email')}}">{{ theme_option('email')}}</a></li>
                                </ul>
                                <p class="text-right mt-2"><a href="/{{$lang}}/contact-us" class="btn btn-sm btn-hover-fill">{{ __("Our Contacts")}}</a></p>
                            </div>
                        </div>
                        <div class="col col-close"><a href="#" class="js-quickLinks-close"><i class="icon-top" data-toggle="tooltip" data-placement="top" title="Close panel"></i></a></div>
                    </div>
                </div>
                <div class="quickLinks-open js-quickLinks-open"><span data-toggle="tooltip" data-placement="left" title="Open panel">+</span></div>
            </div>
        </div>
        <div id="mainSliderWrapper">
            <div class="loading-content">
                <div class="inner-circles-loader"></div>
            </div>
            <div class="main-slider arrows-white arrows-bottom" id="mainSlider" data-slick='{"arrows": false, "dots": false}'>
                @foreach($sliders as $slider)
                <div class="slide">
                    <div class="img--holder" data-animation="kenburns" data-bg="{{ RvMedia::getImageUrl($slider->image, null, false, RvMedia::getDefaultImage()) }}"></div>
                    <div class="slide-content center">
                        <div class="vert-wrap container">
                            <div class="vert">
                                <div class="container">
                                    <div class="slide-txt1 transparent_background" data-animation="fadeInDown" data-animation-delay="1s">{{ $slider->title }}</div>
                                    <div class="slide-txt2 transparent_background" data-animation="fadeInUp" data-animation-delay="1.5s">{{ $slider->description }}</div>
                                    <div class="slide-btn"><a href="{{ $slider->link }}" class="btn btn-white" data-animation="fadeInUp" data-animation-delay="2s"><i class="icon-{{$dir}}-arrow"></i><span>{{ __("Know more")}}</span><i class="icon-{{$dir}}-arrow"></i></a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
<!--//section slider-->
@endif
