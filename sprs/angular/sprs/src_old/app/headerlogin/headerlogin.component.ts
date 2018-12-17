import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";
@Component({
  selector: 'app-headerlogin',
  templateUrl: './headerlogin.component.html',
  styleUrls: ['./headerlogin.component.css']
})
export class HeaderloginComponent implements OnInit {
  selectedItem;
  constructor(private router: Router) {
    if (!this.selectedItem) {
      //this.selectedItem = "addreadings";
    }

  }


  ngOnInit() {
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
