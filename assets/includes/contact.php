<?php
if (isPostRequest()) {
    // Instantiate the ContactForm object
    $contact = new Contact();

    // Sanitize user input
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $subject = htmlspecialchars(strip_tags($_POST['subject']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Insert the contact form data into the database
    if ($contact->insertContactForm($name, $email, $subject, $message)) {
        $successMessage = "Your message has been sent successfully!";
    } else {
        $errorMessage = "There was an error sending your message. Please try again.";
    }
}

?>

<section id="dropNote" class="drop-note-background">
    <div class="container "></div>
    <p class="display-6 text-center montserrat-hero">
        Drop A Note
    </p>
    <p class="lead text-center text-light mb-4">
        I’d love to hear from you! Whether you need a fully functional website or have a project in mind, don’t hesitate to get in touch.
    </p>
    </div>
</section>

<section id="contact" class="contact-section py-5">
    <div class="container">
        <?php if (isset($successMessage)): ?>
            <div class="alert alert-success text-center"><?php echo $successMessage; ?></div>
        <?php elseif (isset($errorMessage)): ?>
            <div class="alert alert-danger text-center"><?php echo $errorMessage; ?></div>
        <?php endif; ?>

        <div class="row">
            <!-- Form Inputs -->
            <div class="col-md-6">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input
                            name="name"
                            type="text"
                            class="form-control bg-body-secondary"
                            id="name"
                            placeholder="Enter your name"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input
                            name="email"
                            type="email"
                            class="form-control bg-body-secondary"
                            id="email"
                            placeholder="Enter your email"
                            required />
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input
                            name="subject"
                            type="text"
                            class="form-control bg-body-secondary"
                            id="subject"
                            placeholder="Enter the subject"
                            required />
                    </div>

            </div>
            <!-- Textbox for Message -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea
                        name="message"
                        class="form-control bg-body-secondary"
                        id="message"
                        rows="8"
                        placeholder="Write your message here"
                        required></textarea>
                </div>
                <button type="submit" class="btn btn-secondary btn-lg mt-3 w-100">
                    Send Message
                </button>
            </div>
            <!-- end form -->
            </form>
        </div>
    </div>
</section>