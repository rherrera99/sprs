import { Component, OnInit,ElementRef } from '@angular/core';
import { AngularHttpProvider } from '../angular-http';
import { User } from '../_models';

@Component({
  selector: 'app-ptprofile',
  templateUrl: './ptprofile.component.html',
  styleUrls: ['./ptprofile.component.css']
})
export class PtprofileComponent implements OnInit {
  public loading = false;
  currentUser: User;
  //users: User[] = [];
  profile_pic_main: string;
  server_response: string;
  selectedFile: File;
  
 // public files;
  constructor(private angularHttp: AngularHttpProvider, private elem:ElementRef) { 
   // this.files = []; 
  }

  ngOnInit() {

    this.loading = true;
    this.getProfile();
   // alert(this.users);


  }
  onFileChanged(event) {
    this.selectedFile = event.target.files[0];
    
this.onUpload();
  }
  onUpload() {
    // this.http is the injected HttpClient
    const uploadData = new FormData();
    uploadData.append('myFile', this.selectedFile, this.selectedFile.name);
    console.log(uploadData);
    this.angularHttp.post('fileUpload.json', uploadData)
      .toPromise();
  }
  FileInput(){

    // let files=this.elem.nativeElement.querySelector('#ProfilePhoto').files;
    // // let formData:FormData=new FormData();

    // var formData = new FormData();
    // Array.from(files).forEach(f => formData.append('file',f));

    // let file=files[0];
    // formData.append('ProfilePhoto',file,file.name);
 //   console.log(files);
//console.log(formData);

  }

//   onFileChanged(event: any) {
//     this.files = event.target.files;
// this.onUpload();
//   }
//   onUpload() {
//     console.log(this.files);
//     const formData = new FormData();
//     formData.append('file','asas');
//     // for (const file of this.files) {
//     //     formData.append(name, file, file.name);
//     // }
//     console.log(formData);
//     //this.angularHttp.post('url', formData).subscribe(x => ....);
//   }

  getProfile() {

    this.loading = true;
    var pid = localStorage.getItem('user_id');
    this.angularHttp.post("patientDetails.json", { 'user_id': pid })
      .toPromise()
      .then((response) => {
        this.server_response = JSON.stringify(response.json());
        var data = JSON.parse(this.server_response);
        //console.log(response.json());
       // console.log(data.status);
        if (data.status == 200) {


          this.currentUser = data.data['patientinfo'][0];
          this.profile_pic_main=this.currentUser.profile_pic;
         localStorage.setItem('profile_pic',this.currentUser.profile_pic );
   
         setTimeout(()=>{    //<<<---    using ()=> syntax
          this.loading = false;
     }, 2000);
          
          
        }
        

      })
      .catch((error) => {
        this.server_response = error._body;
        this.loading = false;
      });

  }

}
