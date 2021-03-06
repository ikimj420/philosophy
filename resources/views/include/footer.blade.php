<!-- s-footer
================================================== -->
<footer class="s-footer">
    <div class="s-footer__main">
        <div class="row">
            <div class="col-two md-four mob-full s-footer__sitelinks">
                <h4>Quick Links</h4>
                <ul class="s-footer__linklist">
                <li><a href="/" title="">Home</a></li>
                @guest()
                @else
                    <li><a href="/assignments" title="">To-Do</a></li>
                    <li><a href="/blogs">All Blogs</a></li>
                    <li><a href="/exercises">All Recipes</a></li>
                @endguest
                <li><a href="/contact" title="">Contact</a></li>
                </ul>
            </div> <!-- end s-footer__sitelinks -->
            <div class="col-two md-four mob-full s-footer__archives">
                <h4>Archives</h4>
                <ul class="s-footer__linklist">
                    <li><a href="#0">January 2018</a></li>
                    <li><a href="#0">December 2017</a></li>
                    <li><a href="#0">November 2017</a></li>
                    <li><a href="#0">October 2017</a></li>
                    <li><a href="#0">September 2017</a></li>
                    <li><a href="#0">August 2017</a></li>
                </ul>
            </div> <!-- end s-footer__archives -->
            <div class="col-two md-four mob-full s-footer__social">
                <h4>Social</h4>
                <ul class="s-footer__linklist">
                    <li><a href="#0">Facebook</a></li>
                    <li><a href="#0">Instagram</a></li>
                    <li><a href="#0">Twitter</a></li>
                    <li><a href="#0">Pinterest</a></li>
                    <li><a href="#0">Google+</a></li>
                    <li><a href="#0">LinkedIn</a></li>
                </ul>
            </div> <!-- end s-footer__social -->
        </div>
    </div> <!-- end s-footer__main -->
    <div class="s-footer__bottom">
        <div class="row">
            <div class="col-full">
                <div class="s-footer__copyright">
                    <span>© Copyright Philosophy 2019</span>
                    <span>Site Template by <a href="https://colorlib.com/">Colorlib</a></span>
                </div>
                <div class="go-top">
                    <a class="smoothscroll" title="Back to Top" href="#top"></a>
                </div>
            </div>
        </div>
    </div> <!-- end s-footer__bottom -->
</footer> <!-- end s-footer -->
