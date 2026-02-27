<footer class="footer">
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>GBIS Mojoagung</h3>
                <p>Menyebarkan kasih Kristus ke seluruh dunia</p>
                <div class="social-links">
                    <a href="#" target="_blank" title="Facebook">
                        <i class="fa-brands fa-facebook-f" style="color: white; font-size: 1.2rem;"></i>
                    </a>
                    <a href="https://instagram.com/gbismojoagung" target="_blank" title="Instagram">
                        <i class="fa-brands fa-instagram" style="color: white; font-size: 1.2rem;"></i>
                    </a>
                    <a href="https://www.youtube.com/@GBISMojoagung" target="_blank" title="YouTube">
                        <i class="fa-brands fa-youtube" style="color: white; font-size: 1.2rem;"></i>
                    </a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Link Cepat</h3>
                <a href="{{ route('about') }}">Tentang Kami</a>
                <a href="{{ route('schedules') }}">Jadwal Ibadah</a>
                <a href="{{ route('events') }}">Acara</a>
                <a href="{{ route('contact') }}">Hubungi Kami</a>
            </div>
            
            <div class="footer-section">
                <h3>Kontak</h3>
                @if(isset($churchInfo))
                <p><i class="fa-solid fa-location-dot" style="color: var(--primary-blue); margin-right: 0.5rem;"></i> {{ $churchInfo->address ?? 'Mojoagung, Jombang' }}</p>
                <p><i class="fa-brands fa-whatsapp" style="color: #25D366; margin-right: 0.5rem;"></i> <a href="{{ $churchInfo->whatsapp_link ?? 'https://wa.me/6281234567890' }}" target="_blank" style="color: inherit; text-decoration: none;">WhatsApp</a></p>
                <p><i class="fa-solid fa-envelope" style="color: var(--primary-blue); margin-right: 0.5rem;"></i> {{ $churchInfo->email ?? 'gbismojoagung321@gmail.com' }}</p>
                @else
                <p><i class="fa-solid fa-location-dot" style="color: var(--primary-blue); margin-right: 0.5rem;"></i> Mojoagung, Jombang</p>
                <p><i class="fa-brands fa-whatsapp" style="color: #25D366; margin-right: 0.5rem;"></i> <a href="https://wa.me/6281234567890" target="_blank" style="color: inherit; text-decoration: none;">WhatsApp</a></p>
                <p><i class="fa-solid fa-envelope" style="color: var(--primary-blue); margin-right: 0.5rem;"></i> gbismojoagung321@gmail.com</p>
                @endif
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>&copy; {{ date('Y') }} GBIS Mojoagung. Hak cipta dilindungi.</p>
        </div>
    </div>
</footer>