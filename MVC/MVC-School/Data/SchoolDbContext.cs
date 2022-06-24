using Microsoft.EntityFrameworkCore;
using MVC_School.Models; 

namespace MVC_School.Data
{
    public class SchoolDbContext : DbContext
    {
        public DbSet<Student> Studenten { get; set; }
        
        public DbSet<Locatie> Locaties { get; set; }

        public DbSet<Docent> Docenten { get; set; }

        public DbSet<Vak> Vakken { get; set; }
        
        public DbSet<VakStudent> VakStudenten { get; set; }
        public SchoolDbContext(DbContextOptions<SchoolDbContext> options) : base(options)
        {

        }

        protected override void OnModelCreating(ModelBuilder builder)
        {
            base.OnModelCreating(builder);


            builder.Entity<VakStudent>()
                .HasKey(vs => new { vs.StudentId, vs.VakId });
        }
    }
}
