/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$(document).ready(function(){
                $('.more').click(function(){
                    $('.order-').fadeToggle();
                    $('.basket-box').fadeToggle();                    
                });
                $('.contact-form').click(function(){
                    $('.lightbox-contact-form').fadeIn();
                    $('.lightbox-contact-form').css({display: 'table'});
                });
                $('.contact-form-close').click(function(){
                    $('.lightbox-contact-form').fadeToggle();
                });
            });
