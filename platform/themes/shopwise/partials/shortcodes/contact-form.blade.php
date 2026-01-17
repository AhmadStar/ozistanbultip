<?php
    $lang = app()->getLocale();
    app()->getLocale() == 'ar' ? $dir = 'left' : $dir = "right";
?>

<div class="page-content">
    <!--section-->
    <div class="section mt-0">
        <div class="contact-map" id="googleMapContact"></div>
    </div>
    <!--//section-->
    <!--section-->
    <div class="section mt-0 bg-grey">
        <div class="container">
            <div class="row">
                <div class="col-md">
                    <div class="title-wrap">
                        <h5>{{ __("Clinic Location")}}</h5>
                        <div class="h-decor"></div>
                    </div>
                    <ul class="icn-list-lg">
                        <li><i class="icon-placeholder2"></i> {{ theme_option('address') }}
                        </li>
                    </ul>
                </div>
                <div class="col-md mt-3 mt-md-0">
                    <div class="title-wrap">
                        <h5>{{ __("Contact Info") }}</h5>
                        <div class="h-decor"></div>
                    </div>
                    <ul class="icn-list-lg">
                        <li><i class="icon-telephone"></i>{{ __("Phone") }}: <span class="theme-color"><span class="text-nowrap">{{ theme_option('phone') }},</span> <span class="text-nowrap">{{ theme_option('phone1') }}</span>
                            </span>
                            <br>
                            </span>
                        </li>
                        <li><i class="icon-black-envelope"></i><a href="mailto:{{ theme_option('email') }}">{{ theme_option('email') }}</a></li>
                    </ul>
                </div>
                <div class="col-md mt-3 mt-md-0">
                    <div class="title-wrap">
                        <h5>{{ __("Working Time")}}</h5>
                        <div class="h-decor"></div>
                    </div>
                    <ul class="icn-list-lg">
                        <li><i class="icon-clock"></i>
                            <div>
                                <div class="d-flex"><span>{{ __("Mon-Thu")}}</span><span class="theme-color">08:00 - 20:00</span></div>
                                <div class="d-flex"><span>{{ __("Friday")}}</span><span class="theme-color">07:00 - 22:00</span></div>
                                <div class="d-flex"><span>{{ __("Saturday")}}</span><span class="theme-color">08:00 - 18:00</span></div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--//section-->
    <!--section-->
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md col-lg-5">
                    <div class="pr-0 pr-lg-8">
                        <div class="title-wrap">
                            <h2>{{ __("Get In Touch With Us")}}</h2>
                            <div class="h-decor"></div>
                        </div>
                        <div class="mt-2 mt-lg-4">
                            <p>{{ __("For general questions")}}, {{ __("please send us a message and we’ll get right back to you")}}. {{ __("You can also call us directly to speak with a member of our service team or insurance expert")}}.</p>
                            <p class="p-sm">{{ __("Fields marked with a * are required.")}}</p>
                        </div>
                        <div class="mt-2 mt-md-5"></div>
                        <h5>{{ __("Stay Connected")}}</h5>
                        <div class="content-social mt-15">
                            @foreach(json_decode(theme_option('social_links'), true) as $socialLink)
                                @if (count($socialLink) == 4)
							        <a href="{{ $socialLink[2]['value'] }}" target="_blank" class="hovicon"><i class="icon-{{ $socialLink[0]['value'] }}-logo-circle"></i></a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md col-lg-6 mt-4 mt-md-0">
                        {!! Form::open(['route' => 'public.send.contact', 'method' => 'POST', 'class' => 'contact-form', 'id' => "contactForm"]) !!}
                        <div class="successform contact-success-message">
                            <p>{{ __("Your message was sent successfully!")}}</p>
                        </div>
                        <div class="errorform contact-error-message">
                            <p>{{ __("Something went wrong, try refreshing and submitting the form again.")}}</p>
                        </div>
                        <div>
                            <input type="text" class="form-control" name="name" placeholder="{{ __("Your Name")}}*">
                        </div>
                        <div class="mt-15">
                            <input type="text" class="form-control" name="email" placeholder="{{ __("Email")}}*">
                        </div>
                        <div class="mt-15">
                            <input type="text" class="form-control" name="phone" placeholder="{{ __("Your Phone")}}">
                        </div>
                        <div class="mt-15">
                            <textarea class="form-control" name="message" placeholder="{{ __("Message")}}"></textarea>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-hover-fill"><i class="icon-{{$dir}}-arrow"></i><span>{{ __("Send message")}}</span><i class="icon-{{$dir}}-arrow"></i></button>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
    <!--//section-->
</div>
