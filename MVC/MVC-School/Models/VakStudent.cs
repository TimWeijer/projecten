using System;
using System.ComponentModel.DataAnnotations;
using System.ComponentModel.DataAnnotations.Schema;

namespace MVC_School.Models
{
    public class VakStudent
    {
        [Display(Name = "Student")]
        [ForeignKey("Student")]
        public int StudentId { get; set; }

        public virtual Student Student { get; set; }

        [Display(Name = "Vak")]
        [ForeignKey("Vak")]
        public int VakId { get; set; }

        public virtual Vak Vak { get; set; }

        [Range(1, 40)]
        public int Uren { get; set; }
    }
}
