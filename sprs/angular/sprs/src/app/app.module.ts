import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';
import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { LoginComponent } from './login/login.component';
import { LeftpaneComponent } from './leftpane/leftpane.component';
import { HeaderloginComponent } from './headerlogin/headerlogin.component';
import { AddratingComponent } from './addrating/addrating.component';
import { FooterComponent } from './footer/footer.component';
import { LogindoctorComponent } from './logindoctor/logindoctor.component';
import { LoginpatientComponent } from './loginpatient/loginpatient.component';
import { PagenotfoundComponent } from './pagenotfound/pagenotfound.component';
import { HomeComponent } from './home/home.component';
import { ReadinglistComponent } from './readinglist/readinglist.component';
import { DrprofileComponent } from './drprofile/drprofile.component';
import { AddpatientComponent } from './addpatient/addpatient.component';
import { LeftpanedrComponent } from './leftpanedr/leftpanedr.component';
import { PtprofileComponent } from './ptprofile/ptprofile.component';
import { PatientlistComponent } from './patientlist/patientlist.component';
import { ReadingsComponent } from './readings/readings.component';
import { PtreadingsComponent } from './ptreadings/ptreadings.component';
import{MainafterloginComponent} from './mainafterlogin/mainafterlogin.component';

import { HttpClientModule } from '@angular/common/http';
import { HttpModule } from '@angular/http';

import { AngularHttpProvider } from  './angular-http';
import { PtprofileeditComponent } from './ptprofileedit/ptprofileedit.component';
import { DrprofileeditComponent } from './drprofileedit/drprofileedit.component';
import {NgbModule,NgbTabsetModule} from '@ng-bootstrap/ng-bootstrap';
import {TabsComponent} from "./tabs/tabs.component";
import { LoadingModule,ANIMATION_TYPES } from 'ngx-loading';
import { PtreadingfullComponent } from './ptreadingfull/ptreadingfull.component';
import { DrreadingfullComponent } from './drreadingfull/drreadingfull.component';
import { PtchangepasswordComponent } from './ptchangepassword/ptchangepassword.component';
import { PtforgotComponent } from './ptforgot/ptforgot.component';
import { PtforgotnewComponent } from './ptforgotnew/ptforgotnew.component';
import { DrforgotComponent } from './drforgot/drforgot.component';
import { DrforgotnewComponent } from './drforgotnew/drforgotnew.component';
import { DrchangepasswordComponent } from './drchangepassword/drchangepassword.component';
import { FileUploadModule } from 'ng2-file-upload';
import { PtlistaddComponent } from './ptlistadd/ptlistadd.component';
import { DraddreadingsComponent } from './draddreadings/draddreadings.component';




const appRoutes: Routes = [
  { path: '', component: LoginComponent },
  
  { path: 'logout', component: LoginComponent },
  {
    path: 'readings/add', component: AddratingComponent
  },
  {
    path: 'readings/list', component: ReadinglistComponent
  },
  {
    path: 'profile', component: DrprofileComponent
  },
  {
    path: 'myprofile', component: PtprofileComponent
  },
  {
    path: 'patients/add', component: AddpatientComponent
  },
  {
    path: 'patients/list', component: PatientlistComponent
  },
  {
    path: 'patient/readings/:id', component: PtreadingsComponent
  },
  {
    path: 'patient/edit', component: PtprofileeditComponent
  },
 {
    path: 'dr/edit', component: DrprofileeditComponent
  },
  {
    path: 'readingsone/:id', component: PtreadingfullComponent
  },
  {
    path: 'ptreadingview/:id/:userid', component: DrreadingfullComponent
  },
  {
    path: 'changepassword', component: PtchangepasswordComponent
  },
  {
    path: 'Ptforgot', component: PtforgotComponent
  },
  {
    path: 'fpt/:id', component: PtforgotnewComponent
  },
  
   {
    path: 'drforgot', component: DrforgotComponent
  },
  {
    path: 'fpd/:id', component: DrforgotnewComponent
  },
  {
    path: 'changepassworddr', component: DrchangepasswordComponent
  },
  {
    path: 'patients/Addlist', component: PtlistaddComponent
  },
  {
    path: 'Add/patient/reading/:id', component: DraddreadingsComponent
  },

  
  
  // { path: 'readings', component: HomeComponent },
  // { path: 'profile', component: HomeComponent },
  // { path: 'logout', component: HomeComponent },
  
  { path: '**', component: PagenotfoundComponent }
];


@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    LoginComponent,
    LeftpaneComponent,
    HeaderloginComponent,
    AddratingComponent,
    FooterComponent,
    LogindoctorComponent,
    LoginpatientComponent,
    PagenotfoundComponent,
    HomeComponent,
    ReadinglistComponent,
    DrprofileComponent,
    AddpatientComponent,
    LeftpanedrComponent,
    PtprofileComponent,
    PatientlistComponent,
    ReadingsComponent,
    PtreadingsComponent,
    MainafterloginComponent,
    PtprofileeditComponent,
    DrprofileeditComponent,
    TabsComponent,
    PtreadingfullComponent,
    DrreadingfullComponent,
    PtchangepasswordComponent,
    PtforgotComponent,
    PtforgotnewComponent,
    DrforgotComponent,
    DrforgotnewComponent,
    DrchangepasswordComponent,
    PtlistaddComponent,
    DraddreadingsComponent,

   

  ],
  imports: [
    BrowserModule,
    FormsModule,
    ReactiveFormsModule,
    HttpClientModule,
    HttpModule,
    NgbModule.forRoot(),
    FileUploadModule,
    LoadingModule.forRoot({ animationType: ANIMATION_TYPES.threeBounce,
      backdropBorderRadius: '10px',
      primaryColour: '#4b181a', secondaryColour: '#181f2a', tertiaryColour: '#4b181a' }),
    RouterModule.forRoot(
      appRoutes,
      { enableTracing: false } // <-- debugging purposes only
    )
  ],
  providers: [AngularHttpProvider,HeaderloginComponent],
  bootstrap: [AppComponent]
})
export class AppModule { 

  public loading = false;
}
