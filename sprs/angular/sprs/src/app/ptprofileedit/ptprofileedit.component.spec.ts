import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtprofileeditComponent } from './ptprofileedit.component';

describe('PtprofileeditComponent', () => {
  let component: PtprofileeditComponent;
  let fixture: ComponentFixture<PtprofileeditComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtprofileeditComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtprofileeditComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
