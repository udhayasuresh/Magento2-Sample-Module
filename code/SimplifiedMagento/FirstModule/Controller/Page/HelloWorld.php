<?php

namespace SimplifiedMagento\FirstModule\Controller\Page;

use Magento\Framework\App\ResponseInterface;

class HelloWorld extends \Magento\FrameWork\App\Action\Action
{
    
    public function execute()
    {
        echo '<h1>Booking page</h1>

<form>
    <input name="firstname" type="text">
    <input name="lastname" type="text">
    <input name="phone" type="text">
    <input name="bookingTime" type="date">
    <input type="submit" value="Send booking informations">
</form>';
    }
    
}
    
    