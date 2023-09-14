<div id="footer">
    <footer id="colophon" class="site-footer" itemscope="itemscope" itemtype="http://schema.org/WPFooter" role="contentinfo">
        <div class="footermenu">
            <div class="menu-footer-container">
                <ul id="menu-footer" class="menu">
                    <li id="menu-item-267884" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-267884">
                        <a href="{{ route('dmca') }}" itemprop="url">DMCA</a>
                    </li>
                    <li id="menu-item-267885" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-267885">
                        <a href="{{ route('contact') }}" itemprop="url">Contact</a>
                    </li>
                    <li id="menu-item-293625" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-privacy-policy menu-item-293625">
                        <a href="{{ route('privacy-policy') }}" itemprop="url">Privacy Policy</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="footercopyright">
            <div class="footer-az">
                <span class="ftaz">A-Z LIST</span>
                <span class="size-s">Cari manga dari A sampai Z.</span>
                <ul class="ulclear az-list">
                    @foreach (range('A', 'Z') as $char)
                        <li>
                            <a href="{{ url('comic/list#'.$char) }}">{{ $char }}</a>
                        </li>
                    @endforeach
                </ul>
                <div class="clear"></div>
            </div>
            <div class="socialbutton">
                <a href="#" class="scfb" target="_blank">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="#" class="scig" target="_blank">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="#" class="scdc" target="_blank">
                    <i class="fab fa-discord"></i>
                </a>
            </div>
            <div class="copyright">
                <div class="txt">
                    <p>Semua komik di website ini hanya preview dari komik aslinya, mungkin terdapat banyak kesalahan bahasa, nama tokoh, dan alur cerita. Untuk versi aslinya, silahkan beli komiknya jika tersedia di kotamu.</p>
                </div>
            </div>
        </div>
    </footer>
</div>