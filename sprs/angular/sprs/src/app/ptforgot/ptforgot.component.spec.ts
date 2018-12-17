import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtforgotComponent } from './ptforgot.component';

describe('PtforgotComponent', () => {
  let component: PtforgotComponent;
  let fixture: ComponentFixture<PtforgotComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtforgotComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtforgotComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
