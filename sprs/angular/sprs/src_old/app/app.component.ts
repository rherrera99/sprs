import { Component } from '@angular/core';
import { Router } from "@angular/router";

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'SPRS';

  constructor(private router: Router) {
    
  }

  ngOnInit() {
    //alert(this.router.url);
    //this.router.navigateByUrl('/');
  } 


}