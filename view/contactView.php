<?php ob_start(); ?>


<section class="mb-4">


    <h2 class="h1-responsive font-weight-bold text-center my-4">Nous Contacter</h2>

    <p class="text-center w-responsive mx-auto mb-5">Vous avez des questions ? N'hésitez pas à nous contacter directement. Notre équipe vous répondra dans les heures qui suivent pour vous aider.</p>
    <div class="row">
        <div class="col-md-9 mb-md-0 mb-5">
            <form id="contact-form" name="contact-form" action="mail.php" method="POST">
                <div class="row">
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="name" name="name" class="form-control">
                            <label for="name" class="">Votre Nom</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email" class="form-control">
                            <label for="email" class="">Votre email</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form mb-0">
                            <input type="text" id="subject" name="subject" class="form-control">
                            <label for="subject" class="">Sujet</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="md-form">
                            <textarea type="text" id="message" name="message" rows="2" class="form-control md-textarea"></textarea>
                            <label for="message">Votre message</label>
                        </div>

                    </div>
                </div>
            </form>
            <div class="text-center text-md-left">
                <a class="btn btn-primary" onclick="document.getElementById('contact-form').submit();">Envoyer</a>
            </div>
            <div class="status"></div>
        </div>
        <div class="col-md-3 text-center">
            <ul class="list-unstyled mb-0">
                <li><i class="fas fa-map-marker-alt fa-2x"></i>
                    <p>Coding Factory, Cergy, France</p>
                </li>

                <li><i class="fas fa-phone mt-4 fa-2x"></i>
                    <p>01 30 75 35 52</p>
                </li>

                <li><i class="fas fa-envelope mt-4 fa-2x"></i>
                    <p>infoitescia@itescia.fr</p>
                </li>
            </ul>
        </div>
    </div>
</section>

<?php $content = ob_get_clean(); ?>

<?php require('dashboard.php'); ?>
