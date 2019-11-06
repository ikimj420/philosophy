@extends('layouts.site')
@section('content')
    <!-- s-content
    ================================================== -->
    <section class="s-content s-content--narrow">

        <div class="row">

            <div class="s-content__header col-full">
                <h1 class="s-content__header-title">
                    If you need to contact us.
                </h1>
            </div> <!-- end s-content__header -->

            <div class="s-content__media col-full">
                <div id="map-wrap">
                    <div id="map-container"></div>
                    <div id="map-zoom-in"></div>
                    <div id="map-zoom-out"></div>
                </div>
            </div> <!-- end s-content__media -->

            <div class="col-full s-content__main">

                <p class="lead">Ovde ide neka glupost.</p>

                <div class="row">
                    <div class="col-six tab-full">
                        <h3>Where to Find Us</h3>

                        <p>
                            1600 Amphitheatre Parkway<br>
                            Mountain View, CA<br>
                            94043 US
                        </p>

                    </div>

                    <div class="col-six tab-full">
                        <h3>Contact Info</h3>

                        <p>contact@philosophywebsite.com<br>
                            info@philosophywebsite.com <br>
                            Phone: (+1) 123 456
                        </p>

                    </div>
                </div> <!-- end row -->

                <h3>Say Hello.</h3>

                <form method="post" action="/contact">
                    <fieldset>
                        @csrf
                        <div class="form-field">
                            <input name="name" type="text" class="full-width" placeholder="Your Name" @guest @else  value="{!! Auth::user()->fullName !!}"  @endguest>
                        </div>

                        <div class="form-field">
                            <input name="email" type="text" class="full-width" placeholder="Your Email" @guest @else  value="{!! Auth::user()->email !!}"  @endguest>
                        </div>

                        <div class="message form-field">
                            <textarea name="message" class="full-width" placeholder="Your Message" ></textarea>
                        </div>

                        <button type="submit" class="submit btn btn--primary full-width">Send Message</button>

                    </fieldset>
                </form> <!-- end form -->


            </div> <!-- end s-content__main -->

        </div> <!-- end row -->

    </section> <!-- s-content -->
@endsection
