import { Component, OnInit } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';

@Component({
  selector: 'app-ptlistadd',
  templateUrl: './ptlistadd.component.html',
  styleUrls: ['./ptlistadd.component.css']
})
export class PtlistaddComponent implements OnInit {
  public loading = false;
  currentUser: User;
  patientlist: User[] = [];
  server_response: string;
  theHtmlString:string;
  constructor(private angularHttp: AngularHttpProvider) {
    this.theHtmlString="";
   }

  ngOnInit() {

    this.getDrPatientList();
  }
  getDrPatientList() {
    //this.loading = true;
    var sendData = {'dr_id':localStorage.getItem('dr_id')}
    this.angularHttp.post("getDrPatientList.json", sendData)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);
        //console.log(response.json());
       // console.log(data.status);
        if (data.status == 200) {
          this.patientlist = data.data['patientlist'];
          console.log(data.data['patientlist']);
          this.loading = false;
        }else {

          this.loading = false;
          this.theHtmlString = data.message;
           console.log(data);
          // this.formList['TabledData']['colum_value'] =[];
 
         }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

  }
}
