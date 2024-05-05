
<html>
    <head>
      <title></title>
      <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700& display=swap" rel="stylesheet">
  
    <style> 
    body{
        background: #ddd;
    }
    * {
      font-family: "Inter", sans-serif;
    }

    #table-container {
      width: 648px;
      border-collaps: collapse;
      border: 0;
      border-spacing: 0;
      background: #fff;
    }
    #table-container #table-content {
        padding: 2.5rem;
    }
    
    @media screen and (max-width: 640px) {
      #table-container {
        width: 100%;
      }
      #table-container #table-content {
        padding: 1rem .4rem;
    }
       #footer > td {
       padding: 2rem 1.2rem 1.2rem 1.2rem !important;
      }
    }
    </style>
    </head>
    <body>
    <table role="presentation" cellpadding="0" border="0" align="center" id="table-container">
 <tr>
   <td id="table-content">
      <table style="width: 100%">
     <tr>
     <td style="border-bottom: 0.4px solid #E0E0E0; width: 100%; padding-bottom: 1.5rem;">
  <img src="https://i.postimg.cc/pr6xBgR2/logos.png" alt="" width="100px" />
     </td>
   </tr>
        <tr>
           <td>
             <p style="font-size: 24px; color: #4F4F4F; font-weight:  600; margin-top: 30px;"><b> Password Reset </b></p>
       <p style="color: #828282; font-size: 14px; font-weight: 400;"></p>
       <p style="color: #828282; font-size: 14px; line-height: 2.0; font-weight: 400;">It looks like you’ve made a password reset request. Please click the button below
to reset your password.</p>
             <a href="{{route('pass.reset.form', $token)}}">
               <button style="width: 100%; height: 50px; border: none; background: #F5A623; font-size: 14px; color: #fff; border-radius: 4px; cursor: pointer; margin-bottom: 1rem;"> Reset Password </button>
             </a>
             <p style="font-size: 14px; color: #828282; line-height: 1.5;">Need help?  <a href="#contact" style="color: #F5A623; text-decoration: none;"> Contact us </a> right away.</p>
     </td>
        </tr>
  </table>
   </td>
 </tr>
<!--    -->

  
</table>
    </body>
  </html>
