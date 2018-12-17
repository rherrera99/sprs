import { Component, OnInit } from '@angular/core';
import { Router } from "@angular/router";


@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.css']
})
export class HomeComponent implements OnInit {
  selectedItem;

  constructor(private router: Router) {
    if (!this.selectedItem) {
      //this.selectedItem = "addreadings";
    }

  }

  ngOnInit() {
   
  }

  listClick(event, newValue) {

  }

}
