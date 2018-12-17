import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtprofileComponent } from './ptprofile.component';

describe('PtprofileComponent', () => {
  let component: PtprofileComponent;
  let fixture: ComponentFixture<PtprofileComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtprofileComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtprofileComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
