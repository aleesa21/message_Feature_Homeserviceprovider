<style>
/* Footer styling */
.footer {
    background-color: #343a40;
    color: #fff;
    padding: 20px 0;
    text-align: center;
    width: 100%;
    margin-top: auto;
    position: relative;
    box-sizing: border-box;
    font-size: 1rem;
}

.footer-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    max-width: 1200px;
    margin: 0 auto;
}

.footer-section {
    flex: 1;
    min-width: 250px;
    margin: 10px;
    text-align: left;
}

.footer-section h3 {
    color: #fff;
    margin-bottom: 15px;
    font-size: 1.4rem;
}

.footer-section p,
.footer-section a {
    color: #d1d3d5;
    font-size: 1rem;
    line-height: 1.6;
    display: block;
    margin-bottom: 10px;
}

.footer-section a:hover {
    color: #00b8d4;
    text-decoration: underline;
}

.footer-section.biratnagar-info p {
    font-weight: bold;
}

.footer-section.contact-info p {
    margin-bottom: 5px;
}

.social-icons {
    display: flex;
    justify-content: center;
    margin-top: 15px;
}

.social-icons a {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background-color: rgba(255, 255, 255, 0.1);
    color: #fff;
    margin: 0 10px;
    font-size: 1.4rem;
    transition: background-color 0.3s ease;
}

.social-icons a:hover {
    background-color: #00b8d4;
    color: #fff;
}

.copyright {
    margin-top: 20px;
    font-size: 0.9rem;
    color: #d1d3d5;
    text-align: center;
}


@media (max-width: 768px) {
    .footer-container {
        flex-direction: column;
        text-align: center;
    }

    .footer-section {
        min-width: 100%;
        text-align: center;
    }

    .social-icons {
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .footer-section h3 {
        font-size: 1.2rem;
    }

    .footer-section p,
    .footer-section a {
        font-size: 0.9rem;
    }

    .social-icons a {
        width: 35px;
        height: 35px;
        font-size: 1.2rem;
        margin: 0 5px;
    }

    .copyright{
        font-size: 0.8rem;
    }
}
</style>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section about-us">
            <h3>Home Service Provider</h3>
            <p>
                Home Service Provider is your one-stop platform for finding reliable home service providers in Biratnagar. We
                connect you with qualified professionals for all your home needs.
            </p>
        </div>
        <div class="footer-section contact-info">
            <h3>Contact Us</h3>
            <p>📍 Biratnagar, Nepal</p>
            <p>📧 homeserviceprocider@gmail.com</p>
            <p>📞 +977-98XXXXXXXX</p>
        </div>
        <div class="footer-section links">
            <h3>Quick Links</h3>
            <a href="#">Home</a>
            <a href="#">Services</a>
            <a href="#">Providers</a>
            <a href="#">About Us</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="footer-section biratnagar-info">
            <h3>Serving Biratnagar</h3>
            <p>We proudly serve the Biratnagar metropolitan area, connecting residents with trusted service providers.</p>
        </div>
        <div class="social-icons">
            <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
            <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" title="LinkedIn"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
    <div class="copyright">
        &copy; <?php echo date("Y"); ?> Home Service Provider. All rights reserved.
    </div>
</footer>
