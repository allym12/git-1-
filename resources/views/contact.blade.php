<x-layouts.main>
 <div class="container  mt-5 mb-5  justify-content-center align-items-center width="70%">
        <div class="row ">
            <div class="col-md-6 bg-primary text-white p-4">
                <!-- Contact Information -->
                <h2>Contact Information</h2>
                <br>
                <br>
                
                <h4><strong>Website:</strong> <a href="https://www.example.com" class="text-white">www.worldmarketconnect.rw</a></h4>
                <br>
                <h4><strong>Email:</strong> worldmarketconnect077@gmail.com</h4>
                <br>
                <br>
                <h4><strong>Phone:</strong> +250789723974</h4>
                <br>
                <br>
                <h4><strong>Location:</strong> Kigali city Rwanda</h4>
            </div>
            <div class="col-md-6">
                <!-- Contact Form -->
                <h2 class="mb-4">Contact Us</h2>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="senderName">Your Name:</label>
                        <input type="text" class="form-control" id="senderName" name="senderName" required>
                    </div>
                    <div class="form-group">
                        <label for="senderEmail">Your Email:</label>
                        <input type="email" class="form-control" id="senderEmail" name="senderEmail" required>
                    </div>
                    <div class="form-group">
                        <label for="senderPhone">Your Phone Number:</label>
                        <input type="tel" class="form-control" id="senderPhone" name="senderPhone" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message:</label>
                        <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
</x-layouts.main>
