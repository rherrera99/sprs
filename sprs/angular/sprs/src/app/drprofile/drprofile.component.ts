import { Component, OnInit } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';

@Component({
  selector: 'app-drprofile',
  templateUrl: './drprofile.component.html',
  styleUrls: ['./drprofile.component.css']
})
export class DrprofileComponent implements OnInit {

  public loading = false;
  currentUser: User;
//  dr: User[] = [];
  server_response: string;

  constructor(private angularHttp: AngularHttpProvider) { }

  ngOnInit() {
    this.getdrProfile();
  }

  getdrProfile() {
    this.loading = true;
    var sendData = {'dr_id':localStorage.getItem('dr_id')}
    this.angularHttp.post("drDetails.json", sendData)
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);
        //console.log(response.json());
       // console.log(data.status);
        if (data.status == 200) {
          this.currentUser = data.data['drinfo'][0];
          // /localStorage.setItem('profile_pic',data.data["doctorinfo"]['profile_pic'] );
          localStorage.setItem('profile_pic',this.currentUser.profile_pic );
          //console.log(this.currentUser);
          setTimeout(()=>{    //<<<---    using ()=> syntax
            this.loading = false;
       }, 2000);
         // this.loading = false;
        }


      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

  }


}
