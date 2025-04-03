<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .logo-container {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            max-height: 80px;
        }
        .success-icon {
            font-size: 5rem;
            color: #198754;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Header with logos -->
                <div class="logo-container">
                    <img src="<?php echo e(asset('assets/images/dot-logo.jpg')); ?>" alt="DoT Logo">
                    <img src="<?php echo e(asset('assets/images/five-g.png')); ?>" alt="5G Hackathon Logo">
                </div>

                <div class="card shadow">
                    <div class="card-header bg-success text-white">
                        <h4 class="mb-0">Registration Successful</h4>
                    </div>
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-check-circle success-icon"></i>
                        </div>
                        <h4 class="mb-3">Thank you for registering!</h4>
                        <p class="lead">Your registration has been submitted successfully.</p>
                        <p>We will review your application and get back to you at <strong><?php echo e($email); ?></strong></p>
                        <div class="mt-4">
                            <a href="<?php echo e(url('/')); ?>" class="btn btn-primary">Back to Home</a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-3">
                    <p>Department of Telecommunications | Government of India © 2023</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\Deepak\Desktop\toc\resources\views/pages/lab-registration/success.blade.php ENDPATH**/ ?>