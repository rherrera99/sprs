import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { PtforgotnewComponent } from './ptforgotnew.component';

describe('PtforgotnewComponent', () => {
  let component: PtforgotnewComponent;
  let fixture: ComponentFixture<PtforgotnewComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ PtforgotnewComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(PtforgotnewComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
