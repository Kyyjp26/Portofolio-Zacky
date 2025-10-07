<?php
get_header();
?>

<div class="container py-4">
    <h2 class="text-center mb-4">Contact</h2>
    <div class="contact-container">
        <div>
            <h2 class="mb-4">Contact Form</h2>
            <form action="" class="contact-form">
                <div class="flex gap-1 mb-2 flex-column">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name">
                </div>
                <div class="flex gap-1 mb-2 flex-column">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">
                </div>
                <div class="flex gap-1 mb-2 flex-column">
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="10"></textarea>
                </div>
                <button class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="contact-info">
            <div>
                <h2 class="mb-4">Contact Information</h2>
                <div class="mb-2 flex flex-column gap-1">
                    <p>Address: Jl. Raya No. 123, Jakarta, Indonesia</p>
                    <p>Email: example@gmail.com</p>
                    <p>Phone: +62 123 4567 890</p>
                </div>
                <div>
                    <p class="mb-2">Sosial Media:</p>
                    <ul>
                        <li>
                            <a href="http://facebook.com">Facebook</a>
                        </li>
                        <li>
                            <a href="http://youtube.com">Youtube</a>
                        </li>
                        <li>
                            <a href="http://instagram.com">Instagram</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php
get_footer();
?>