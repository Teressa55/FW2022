<?php

get_header();

if (!empty($_POST)) {
    // Sanitize the POST field
    // Generate email content
    // Send to appropriate email
    echo $_POST['message'];
}

?>
<main>
    <div id="content">
        <form action="" method="post">
            <label for="fullname">Full Name</label>
            <input type="text" name="fullname" id="fullname" required>
            <label for="email">Email Address</label>
            <input type="email" name="email" id="email" required>
            <label for="message">Your Message</label>
            <textarea name="message" id="message"></textarea>
            <input type="submit" value="Send My Message">
        </form>
    </div>
</main>

<?php get_footer() ?>