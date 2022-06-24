using System.ComponentModel.DataAnnotations;
using System.Collections.Generic;

namespace MVC_School.Models
{
    public class Student
    {
        public Student()
        {
            StudentVakken = new HashSet<VakStudent>();
        }
        public int Id { get; set; }
        
        [StringLength(20)]
        public string Voornaam { get; set; }

        [StringLength(40)]
        public string Achternaam { get; set; }

        [StringLength(40)]
        public string Adres { get; set; }

        [StringLength(40)]
        public string Woonplaats { get; set; }

        public ICollection<VakStudent> StudentVakken { get; set; }
    }
}
