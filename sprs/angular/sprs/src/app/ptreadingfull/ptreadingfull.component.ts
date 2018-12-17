import { Component, OnInit } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { Router } from "@angular/router";
import { ActivatedRoute } from "@angular/router";

@Component({
  selector: 'app-ptreadingfull',
  templateUrl: './ptreadingfull.component.html',
  styleUrls: ['./ptreadingfull.component.css']
})
export class PtreadingfullComponent implements OnInit {
  listID: string;
  public loading = false;
  readinglist: any;
  theHtmlString: string;
  server_response: string;

  constructor(private router: Router, private angularHttp: AngularHttpProvider,private activatedroute: ActivatedRoute) { 
    const routeParams = this.activatedroute.snapshot.params;
    this.theHtmlString = '';
    this.listID = routeParams.id;  
  }
 
  ngOnInit() {
   this.viewReadingId();

  }

viewReadingId(){
  this.loading = true;
 
  this.angularHttp.post("viewReadingId.json", { 'id': this.listID ,'user_id':localStorage.getItem('user_id')})
    .toPromise()
    .then((response) => {
      this.server_response = JSON.stringify(response.json());
      var data = JSON.parse(this.server_response);

      if (data.status == 200) {
       // this.currentUser = data.data['patientinfo'][0];
       this.readinglist = data.data['form_list'];

        this.loading = false;

      }


    })
    .catch((error) => {
      this.server_response = error._body;
    //  this.loading = false;
    });

}


}
