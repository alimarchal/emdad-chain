<footer id="footer">

    <div class="footer-top" >
        <div class="container">
            <div class="row">

                <div class="col-lg-4 col-md-6 footer-contact">
                    <h3>{{config('app.name')}} <img src="logo-full.png" style="max-width: 70px;"></h3>
                    <p>
                        120 Aban Center, <br>
                        King Abdul Aziz Road, Exit 5,<br>
                        Riyadh - 13525, Kingdom of Saudi Arabia (KSA)<br>
                        <strong>Phone:</strong> <span style="font-family:tahoma;">+966 53 416 8874</span><br>
                        <strong>Contact:</strong> contact@emdad-chain.com<br>
                        <strong>Support:</strong> support@emdad-chain.com<br>
                        <strong>General:</strong> info@emdad-chain.com<br>
                    </p>
                </div>


                <div class="col-lg-4 col-md-6 footer-links ">
                    <h4>Useful Links</h4>
                    <ul style="list-style-type: none; padding: 0px;margin:0px;">
                        <li><i class="bx bx-chevron-right"></i> <a href="{{config('app.url')}}">Home</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('aboutUs')}}">About us</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('services')}}">Services</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('ourTeam')}}">Our Team</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('support')}}">Contact</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-6 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                    </ul>
                </div>

{{--                <div class="col-lg-4 col-md-6 footer-newsletter">--}}
{{--                    <h4>Join Our Newsletter</h4>--}}
{{--                    <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>--}}
{{--                    <form action="" method="post">--}}
{{--                        <input type="email" name="email"><input type="submit" value="Subscribe">--}}
{{--                    </form>--}}
{{--                </div>--}}

            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="me-md-auto text-center text-md-left">
            <div class="copyright">
                &copy; Copyright {{date('Y')}} - <strong><span>{{config('app.name')}}</span></strong>. All Rights Reserved
            </div>
            <div class="credits">
                {{--                Designed by <a href="#">Ali Raza Marchal</a>--}}
            </div>
        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="https://twitter.com/emdad_chain?s=21" class="twitter"><i class="bx bxl-twitter"></i></a>
{{--            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>--}}
            <a href="https://instagram.com/emdad_chain?igshid=ok4zahralc2t" class="instagram"><i class="bx bxl-instagram"></i></a>
{{--            <a href="#" class="google-plus"><i class="bx bxl-pinterest"></i></a>--}}
            <a href="https://www.linkedin.com/company/emdadchain" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer>
