<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="mb-3">
                    <i class="fas fa-car me-2"></i>AutoRent
                </h5>
                <p class="text-muted">
                    Votre partenaire de confiance pour la location de véhicules. 
                    Nous proposons une large gamme de voitures pour tous vos besoins.
                </p>
                <div class="social-links">
                    <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="me-3"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="mb-3">Services</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('vehicles.index') }}">Nos Véhicules</a></li>
                    <li><a href="{{ route('reservations.create') }}">Réserver</a></li>
                    <li><a href="#">Assurance</a></li>
                    <li><a href="#">Assistance 24/7</a></li>
                </ul>
            </div>
            
            <div class="col-lg-2 col-md-6 mb-4">
                <h5 class="mb-3">Support</h5>
                <ul class="list-unstyled">
                    <li><a href="#">Centre d'aide</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Conditions</a></li>
                </ul>
            </div>
            
            <div class="col-lg-4 col-md-6 mb-4">
                <h5 class="mb-3">Contact</h5>
                <div class="contact-info">
                    <p class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        123 Rue de la Location, Casablanca
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-phone me-2"></i>
                        +212 5 22 123 456
                    </p>
                    <p class="mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        contact@autorent.ma
                    </p>
                </div>
            </div>
        </div>
        
        <hr class="my-4" style="border-color: #374151;">
        
        <div class="row align-items-center">
            <div class="col-md-6">
                <p class="mb-0 text-muted">
                    © {{ date('Y') }} AutoRent. Tous droits réservés.
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="mb-0 text-muted">
                    <i class="fas fa-shield-alt me-1"></i>
                    Paiement sécurisé
                </p>
            </div>
        </div>
    </div>
</footer>
