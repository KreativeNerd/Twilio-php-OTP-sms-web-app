# CONFIGURING TWILIO
## first and formost create a free account with twilio using this link https://www.twilio.com/try-twilio

## Once you complete the SignUp process, Proceed to Console page on Twilio and note down your ACCOUNT SID and AUTH TOKEN. Both will be used by us later in our implementation.

## You will be asked to select "From Number", you should select the number as is because the number itself does not matter as of now. This is the number from which Twilio would be sending text messages on your behalf.

## After doing all the above steps, finally, your Twilio setup is Complete.

# DATABASE SCHEMAS: For the sake of simplicity, I have created only one table named users which has the following schemas: id(datatype = INT) , phone_number(datatype = VARCHAR) , otp(datatype = INT) , is_verified(datatype = INT)

# STEPS TO RUN:
## Download and install composer on your computer if you don't have any
## Just Clone this code and run "composer install" after moving into the project's directory.
## The composer would automagically (after reading the composer.json file) import the necessary Twilio SDK.
## You just need to set up your virtual host and you are good to go.