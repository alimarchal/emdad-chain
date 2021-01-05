<footer id="footer" style="direction: rtl">

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
                    <h4>روابط مفيدة</h4>
                    <ul style="list-style-type: none; padding: 0px;margin:0px;">
                        <li><i class="bx bx-chevron-right"></i> <a href="{{url('/')}}">الرئيسية</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('aboutUsAr')}}">من نحن</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('servicesAr')}}">خدماتنا</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('ourTeamAr')}}">فريق العمل</a></li>
                        <li><i class="bx bx-chevron-right"></i> <a href="{{route('supportAr')}}">الدعم</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container d-md-flex py-4">

        <div class="    text-md-right" style="margin-left: auto!important;">
            <div class="copyright" >
                &copy; حقوق الطبع والنشر {{date('Y')}} - <strong><span>منصة إمداد</span></strong> ۔ جميع الحقوق محفوظة
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
