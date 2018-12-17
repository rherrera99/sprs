import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";
import * as $ from 'jquery';

@Component({
  selector: 'app-headerlogin',
  templateUrl: './headerlogin.component.html',
  styleUrls: ['./headerlogin.component.css']
})
export class HeaderloginComponent implements OnInit {
  selectedItem;
  public loading = false;
  loginChack: any;
  constructor(private router: Router) {
    this.loginChack = '';
    if (!this.selectedItem) {
      //this.selectedItem = "addreadings";
    }

  }


  ngOnInit() {


   $('.nav-toggler').click(function() {
    if($('.mini-sidebar').hasClass('blue'))
    {
        $('.mini-sidebar').addClass('show-sidebar').removeClass('blue');
    }
    else
    {
       $('.mini-sidebar').addClass('blue').removeClass('show-sidebar');
    }
  });
    //$("body").removeClass("show-sidebar");
    if (localStorage.getItem('user_id')) {
      this.loginChack = 'pt';

    } else {
      this.loginChack = 'dr';

    }


    if (localStorage.getItem('isLoggedIn') == "true") {
      if (this.selectedItem == "addreadings") {
        this.router.navigateByUrl('/readings/add')
      } else if (this.selectedItem == "readings") {
        this.router.navigateByUrl('/readings/list')
      } else if (this.selectedItem == "profile") {
        this.router.navigateByUrl('/profile')
      } else if (this.selectedItem == "logout") {
        this.router.navigateByUrl('/')
      }

    }
    else {

      this.router.navigateByUrl('/')
    }

  }
  // toggleClass() {
   
  //   alert('cklickck');
  //   //   $(".nav-toggler").click(function() {
  //   //     $("body").toggleClass("show-sidebar");
  //   //     $(".nav-toggler i").toggleClass("ti-menu");
  //   //     $(".nav-toggler i").addClass("ti-close");
  //   // });
  //   // $(".sidebartoggler").on('click', function() {
  //   //   $("body").toggleClass("show-sidebar");
  //   //     $(".sidebartoggler i").toggleClass("ti-menu");
  //   //     $(".nav-toggler i").toggleClass("ti-close");
  //   // });

  //   // $('.nav-toggler').one('click', function () {
  
  //   //   $(".mini-sidebar").addClass("show-sidebar");

  //   //   $('.nav-toggler').one('click', function () {

  //   //     $(".mini-sidebar").removeClass("show-sidebar");

  //   //   });
  //   // });

  //   // if ($('.mini-sidebar').hasClass('show-sidebar')) {
  //   //   $('.mini-sidebar').addClass('show-sidebar').removeClass('blue');
  //   // }
  //   // else {
  //   //   $('.mini-sidebar').addClass('blue').removeClass('show-sidebar');
  //   // }
  // }

  listClick(event, newValue) {
    console.log(newValue);
    this.selectedItem = newValue;
    if (this.selectedItem == "addreadings") {
      this.router.navigateByUrl('/readings/add')
    } else if (this.selectedItem == "readings") {
      this.router.navigateByUrl('/readings/list')
    } else if (this.selectedItem == "profile") {
      this.router.navigateByUrl('/profile')
    } else if (this.selectedItem == "logout") {
      this.router.navigateByUrl('/')
    }
  }



}
