 <!DOCTYPE html>
 <html>

 <head>
     <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>Register Form</title>
     <style>
         body {
             font-family: Arial, sans-serif;
             background-color: #f4f4f9;
             margin: 13%;
             padding: 0;
             display: flex;
             justify-content: center;
             align-items: center;
             height: 100vh;


         }

         .register-container {
             background: white;
             border-radius: 10px;
             padding: 30px;
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
             width: 400px;
             text-align: center;


         }

         .form-group {
             margin-bottom: 15px;
             text-align: left;
         }

         .form-group label {
             display: block;
             font-size: 14px;
             margin-bottom: 5px;
         }

         .form-group input,
         .form-group select {
             width: 100%;
             padding: 10px;
             font-size: 14px;
             border: 1px solid #ddd;
             border-radius: 5px;
             background-color: #f9f9ff;
         }

         .form-footer {
             margin-top: 15px;
             font-size: 14px;
         }

         .form-footer a {
             color: #007bff;
             text-decoration: none;
         }

         .form-footer a:hover {
             text-decoration: underline;
         }

         .form-actions {
             margin-top: 15px;
         }

         .form-actions button {
             background-color: #3c4858;
             color: white;
             border: none;
             padding: 10px 20px;
             border-radius: 5px;
             cursor: pointer;
             font-size: 14px;
         }

         .form-actions button:hover {
             background-color: #2e3b47;
         }

         .name {
             font-size: 40px;
             font-weight: bold;
             font-family: 'Poppins', sans-serif;
             color: #00509e;
             text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
             letter-spacing: 1px;
             background: linear-gradient(to right, #00509e, #00aaff);
             -webkit-background-clip: text;
             -webkit-text-fill-color: transparent;
             text-transform: uppercase;
             margin: 10px 0;
             text-align: center;
         }

         .text-danger {
             color: red;
         }

         .form-control.is-invalid {
             border: 1px solid red;
             background-color: #ffe6e6;
             /* Optional: light red background for emphasis */
         }
         a {
    text-decoration: none;
}
     </style>
 </head>

 <body>
     <div class="register-container">
     <a href="/">
         <div class="name">Home Service Provider</div>
     </a>
         <form action="{{ route('reguser')}}" method="POST">
             @csrf
             <!-- Register as -->
             <div class="form-group">
                 <label for="register-as">Register as:</label>
                 <select id="register-as" name="register-as">
                     <option value="Customer">Customer</option>
                     <option value="Service-provider">Service Provider</option>
                 </select>
             </div>

             <!-- Name -->
             <div class="form-group">
                 <label for="name">Name</label>
                 <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Enter your name" name="name">
                 <span class="text-danger">
                     @error('name')
                     {{ $message }}
                     @enderror
                 </span>
             </div>

             <!-- Email -->
             <div class="form-group">
                 <label for="email">Email</label>
                 <input type="email" value="{{ old('email') }}" id="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email" name="email">
                 <span class="text-danger">
                     @error('email')
                     {{ $message }}
                     @enderror
                 </span>
             </div>

             <!-- Phone -->
             <div class="form-group">
                 <label for="phone">Phone</label>
                 <input type="number " value="{{ old('phone') }}" id="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Enter your phone number" name="phone">
                 <span class="text-danger">
                     @error('phone')
                     {{ $message }}
                     @enderror
                 </span>
             </div>

             <!-- Address -->
             <div class="form-group">
                 <label for="address">Address</label>
                 <input type="text" value="{{ old('address') }}" id="address" class="form-control @error('address') is-invalid @enderror" placeholder="Enter your address" name="address">
                 <span class="text-danger">
                     @error('address')
                     {{ $message }}
                     @enderror
                 </span>
             </div>

             <!-- Password -->
             <div class="form-group">
                 <label for="password">Password</label>
                 <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter your password" name="password">
                 <span class="text-danger">
                     @error('password')
                     {{ $message }}
                     @enderror
                 </span>
             </div>

             <!-- Confirm Password -->
             <div class="form-group">
                 <label for="confirm-password">Confirm Password</label>
                 <input type="password" id="confirm-password" class="form-control @error('confirm-password') is-invalid @enderror" placeholder="Confirm your password" name="confirm-password">
                 <span class="text-danger">
                     @error('confirm-password')
                     {{ $message }}
                     @enderror
                 </span>
             </div>

             <!-- Already registered -->
             <div class="form-footer">
                 <a href="/login">Already registered?</a>
             </div>

             <!-- Register button -->
             <div class="form-actions">
                 <button type="submit">REGISTER</button>
             </div>
         </form>
     </div>
 </body>

 </html>